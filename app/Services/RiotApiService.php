<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RiotApiService
{
    private $baseUrl = 'https://ddragon.leagueoflegends.com/cdn/12.6.1/data/en_US';

    public function getChampions()
    {
        return Cache::remember('champions', 3600, function () {
            $response = Http::get("{$this->baseUrl}/champion.json");
            return $response->json()['data'];
        });
    }

    public function getChampionDetail($championId)
    {
        return Cache::remember("champion.{$championId}", 3600, function () use ($championId) {
            $response = Http::get("{$this->baseUrl}/champion/{$championId}.json");
            $data = $response->json();
            return $data['data'][$championId] ?? null;
        });
    }
}