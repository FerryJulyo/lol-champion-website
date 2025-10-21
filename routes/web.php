<?php

use App\Http\Controllers\ChampionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChampionController::class, 'index'])->name('home');
Route::get('/champions', [ChampionController::class, 'index'])->name('champions.index');
Route::get('/champions/{championId}', [ChampionController::class, 'show'])->name('champions.show');
Route::get('/roles', [ChampionController::class, 'roles'])->name('champions.roles');
Route::get('/difficulty', [ChampionController::class, 'difficulty'])->name('champions.difficulty');
Route::get('/search', [ChampionController::class, 'search'])->name('champions.search');
Route::get('/about', function () {
    return view('about');
})->name('about');