<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RiotApiService;

class ChampionController extends Controller
{
    private $apiService;

    public function __construct(RiotApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $champions = $this->apiService->getChampions();
        return view('champions.index', compact('champions'));
    }

    public function show($championId)
    {
        $champion = $this->apiService->getChampionDetail($championId);
        
        if (!$champion) {
            abort(404);
        }

        return view('champions.show', compact('champion'));
    }

    public function roles()
    {
        $champions = $this->apiService->getChampions();
        $roles = $this->groupByRole($champions);
        
        return view('champions.roles', compact('roles'));
    }

    public function difficulty()
    {
        $champions = $this->apiService->getChampions();
        $difficultyLevels = $this->groupByDifficulty($champions);
        
        return view('champions.difficulty', compact('difficultyLevels'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $champions = $this->apiService->getChampions();
        
        $results = collect($champions)->filter(function ($champion) use ($query) {
            return stripos($champion['name'], $query) !== false || 
                   stripos($champion['title'], $query) !== false;
        });

        return view('champions.search', compact('results', 'query'));
    }

    private function groupByRole($champions)
    {
        $roles = [];
        
        foreach ($champions as $champion) {
            $tags = $champion['tags'];
            foreach ($tags as $tag) {
                if (!isset($roles[$tag])) {
                    $roles[$tag] = [];
                }
                $roles[$tag][] = $champion;
            }
        }

        return $roles;
    }

    private function groupByDifficulty($champions)
    {
        $levels = [
            'Low' => [],
            'Medium' => [],
            'High' => []
        ];

        foreach ($champions as $champion) {
            $difficulty = $champion['info']['difficulty'];
            
            if ($difficulty <= 3) {
                $levels['Low'][] = $champion;
            } elseif ($difficulty <= 7) {
                $levels['Medium'][] = $champion;
            } else {
                $levels['High'][] = $champion;
            }
        }

        return $levels;
    }
}