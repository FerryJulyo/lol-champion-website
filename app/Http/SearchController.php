<?php

namespace App\Http\Controllers;

use App\Services\ChampionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        private ChampionService $championService
    ) {}

    /**
     * Display search page
     */
    public function index(Request $request): View
    {
        $query = $request->input('q', '');
        $results = collect([]);
        
        if (!empty($query)) {
            $results = $this->championService->searchChampions($query);
        }

        $roles = $this->championService->getAllRoles();

        return view('search', [
            'query' => $query,
            'results' => $results,
            'roles' => $roles,
        ]);
    }

    /**
     * API endpoint for search (AJAX)
     */
    public function api(Request $request): JsonResponse
    {
        $query = $request->input('q', '');
        $role = $request->input('role');
        $difficulty = $request->input('difficulty');
        
        if (empty($query) && empty($role) && empty($difficulty)) {
            return response()->json([
                'success' => true,
                'data' => [],
                'count' => 0,
            ]);
        }

        $filters = [
            'search' => $query,
            'role' => $role,
            'difficulty' => $difficulty,
        ];

        $results = $this->championService->advancedSearch($filters);

        return response()->json([
            'success' => true,
            'data' => $results,
            'count' => $results->count(),
            'query' => $query,
        ]);
    }
}