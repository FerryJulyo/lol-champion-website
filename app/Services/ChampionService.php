<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class ChampionService
{
    private string $apiUrl = 'https://ddragon.leagueoflegends.com/cdn/12.6.1/data/en_US/champion.json';
    private int $cacheDuration = 3600; // 1 hour

    /**
     * Get all champions from API with caching
     */
    public function getAllChampions(): Collection
    {
        return Cache::remember('champions_all', $this->cacheDuration, function () {
            $response = Http::get($this->apiUrl);
            
            if ($response->successful()) {
                $data = $response->json();
                return collect($data['data'])->values();
            }
            
            return collect([]);
        });
    }

    /**
     * Get single champion by ID
     */
    public function getChampionById(string $championId): ?array
    {
        $champions = $this->getAllChampions();
        
        return $champions->firstWhere('id', $championId);
    }

    /**
     * Search champions by name or title
     */
    public function searchChampions(string $query): Collection
    {
        $champions = $this->getAllChampions();
        
        return $champions->filter(function ($champion) use ($query) {
            $searchTerm = strtolower($query);
            return str_contains(strtolower($champion['name']), $searchTerm) ||
                   str_contains(strtolower($champion['title']), $searchTerm);
        });
    }

    /**
     * Filter champions by role/tags
     */
    public function filterByRole(string $role): Collection
    {
        $champions = $this->getAllChampions();
        
        return $champions->filter(function ($champion) use ($role) {
            return in_array($role, $champion['tags']);
        });
    }

    /**
     * Get champions by difficulty level
     */
    public function filterByDifficulty(int $minDiff, int $maxDiff): Collection
    {
        $champions = $this->getAllChampions();
        
        return $champions->filter(function ($champion) use ($minDiff, $maxDiff) {
            $diff = $champion['info']['difficulty'];
            return $diff >= $minDiff && $diff <= $maxDiff;
        });
    }

    /**
     * Get featured champions (highest stats)
     */
    public function getFeaturedChampions(int $limit = 8): Collection
    {
        return $this->getAllChampions()
            ->sortByDesc(function ($champion) {
                return $champion['info']['attack'] + 
                       $champion['info']['defense'] + 
                       $champion['info']['magic'];
            })
            ->take($limit)
            ->values();
    }

    /**
     * Get statistics about champions
     */
    public function getStatistics(): array
    {
        $champions = $this->getAllChampions();
        
        // Count by roles
        $roleStats = [];
        foreach ($champions as $champion) {
            foreach ($champion['tags'] as $tag) {
                $roleStats[$tag] = ($roleStats[$tag] ?? 0) + 1;
            }
        }
        
        // Difficulty distribution
        $difficultyStats = $champions->groupBy('info.difficulty')
            ->map(fn($group) => $group->count())
            ->toArray();
        
        // Average stats
        $avgStats = [
            'attack' => round($champions->avg('info.attack'), 2),
            'defense' => round($champions->avg('info.defense'), 2),
            'magic' => round($champions->avg('info.magic'), 2),
            'difficulty' => round($champions->avg('info.difficulty'), 2),
        ];
        
        return [
            'total_champions' => $champions->count(),
            'role_distribution' => $roleStats,
            'difficulty_distribution' => $difficultyStats,
            'average_stats' => $avgStats,
        ];
    }

    /**
     * Get all unique roles/tags
     */
    public function getAllRoles(): array
    {
        $champions = $this->getAllChampions();
        $roles = [];
        
        foreach ($champions as $champion) {
            $roles = array_merge($roles, $champion['tags']);
        }
        
        return array_unique($roles);
    }

    /**
     * Sort champions by specific stat
     */
    public function sortByStats(string $stat, string $direction = 'desc'): Collection
    {
        $champions = $this->getAllChampions();
        $statPath = "info.{$stat}";
        
        return $direction === 'desc' 
            ? $champions->sortByDesc($statPath)->values()
            : $champions->sortBy($statPath)->values();
    }

    /**
     * Advanced search with multiple filters
     */
    public function advancedSearch(array $filters): Collection
    {
        $champions = $this->getAllChampions();
        
        // Search by name/title
        if (!empty($filters['search'])) {
            $champions = $champions->filter(function ($champion) use ($filters) {
                $search = strtolower($filters['search']);
                return str_contains(strtolower($champion['name']), $search) ||
                       str_contains(strtolower($champion['title']), $search);
            });
        }
        
        // Filter by role
        if (!empty($filters['role'])) {
            $champions = $champions->filter(function ($champion) use ($filters) {
                return in_array($filters['role'], $champion['tags']);
            });
        }
        
        // Filter by difficulty
        if (!empty($filters['difficulty'])) {
            $champions = $champions->filter(function ($champion) use ($filters) {
                return $champion['info']['difficulty'] == $filters['difficulty'];
            });
        }
        
        // Filter by attack type (physical/magic)
        if (!empty($filters['attack_type'])) {
            $champions = $champions->filter(function ($champion) use ($filters) {
                if ($filters['attack_type'] === 'physical') {
                    return $champion['info']['attack'] > $champion['info']['magic'];
                } elseif ($filters['attack_type'] === 'magic') {
                    return $champion['info']['magic'] > $champion['info']['attack'];
                }
                return true;
            });
        }
        
        // Sort
        if (!empty($filters['sort_by'])) {
            $sortBy = $filters['sort_by'];
            $direction = $filters['sort_direction'] ?? 'asc';
            
            $champions = match($sortBy) {
                'name' => $direction === 'desc' 
                    ? $champions->sortByDesc('name') 
                    : $champions->sortBy('name'),
                'attack' => $direction === 'desc'
                    ? $champions->sortByDesc('info.attack')
                    : $champions->sortBy('info.attack'),
                'defense' => $direction === 'desc'
                    ? $champions->sortByDesc('info.defense')
                    : $champions->sortBy('info.defense'),
                'magic' => $direction === 'desc'
                    ? $champions->sortByDesc('info.magic')
                    : $champions->sortBy('info.magic'),
                'difficulty' => $direction === 'desc'
                    ? $champions->sortByDesc('info.difficulty')
                    : $champions->sortBy('info.difficulty'),
                default => $champions
            };
        }
        
        return $champions->values();
    }

    /**
     * Get champion image URL
     */
    public function getChampionImage(string $championId, string $type = 'loading'): string
    {
        $baseUrl = 'https://ddragon.leagueoflegends.com/cdn/12.6.1/img';
        
        return match($type) {
            'splash' => "https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$championId}_0.jpg",
            'square' => "{$baseUrl}/champion/{$championId}.png",
            default => "{$baseUrl}/champion/loading/{$championId}_0.jpg"
        };
    }
}