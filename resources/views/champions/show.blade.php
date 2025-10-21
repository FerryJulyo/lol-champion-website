@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ $champion['name'] }}</h1>
    <p class="page-subtitle">{{ $champion['title'] }}</p>
</div>

<div style="display: grid; grid-template-columns: 300px 1fr; gap: 3rem; margin-top: 2rem;">
    <div>
        <img src="https://ddragon.leagueoflegends.com/cdn/img/champion/loading/{{ $champion['id'] }}_0.jpg" 
             alt="{{ $champion['name'] }}" style="width: 100%; border-radius: 15px; border: 2px solid var(--accent);">
        
        <div class="stats-grid" style="margin-top: 1rem;">
            <div class="stat-card">
                <div class="stat-value">{{ $champion['info']['attack'] }}</div>
                <div class="stat-label">Attack</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $champion['info']['defense'] }}</div>
                <div class="stat-label">Defense</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $champion['info']['magic'] }}</div>
                <div class="stat-label">Magic</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $champion['info']['difficulty'] }}</div>
                <div class="stat-label">Difficulty</div>
            </div>
        </div>
    </div>

    <div>
        <div style="background: rgba(26, 26, 46, 0.8); border-radius: 15px; padding: 2rem; margin-bottom: 2rem;">
            <h3 style="color: var(--accent); margin-bottom: 1rem; font-family: 'Orbitron', sans-serif;">Lore</h3>
            <p style="line-height: 1.6; color: var(--text);">{{ $champion['lore'] }}</p>
        </div>

        <div style="background: rgba(26, 26, 46, 0.8); border-radius: 15px; padding: 2rem;">
            <h3 style="color: var(--accent); margin-bottom: 1rem; font-family: 'Orbitron', sans-serif;">Abilities</h3>
            <div style="display: grid; gap: 1rem;">
                @foreach($champion['spells'] as $spell)
                <div style="display: flex; gap: 1rem; align-items: start; padding: 1rem; background: rgba(0, 243, 255, 0.1); border-radius: 10px;">
                    <img src="https://ddragon.leagueoflegends.com/cdn/12.6.1/img/spell/{{ $spell['image']['full'] }}" 
                         alt="{{ $spell['name'] }}" style="width: 64px; height: 64px; border-radius: 10px;">
                    <div>
                        <h4 style="color: var(--accent); margin-bottom: 0.5rem;">{{ $spell['name'] }}</h4>
                        <p style="color: var(--text); font-size: 0.9rem;">{{ $spell['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<a href="{{ route('champions.index') }}" class="btn" style="margin-top: 2rem;">
    <i class="fas fa-arrow-left"></i> Back to Champions
</a>
@endsection