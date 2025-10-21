@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">LEAGUE OF LEGENDS CHAMPIONS</h1>
    <p class="page-subtitle">Explore all champions and their abilities</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value">{{ count($champions) }}</div>
        <div class="stat-label">Total Champions</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">6</div>
        <div class="stat-label">Primary Roles</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">3</div>
        <div class="stat-label">Difficulty Levels</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">164</div>
        <div class="stat-label">Unique Abilities</div>
    </div>
</div>

<div class="champions-grid">
    @foreach($champions as $champion)
    <div class="champion-card">
        <div class="champion-header">
            <img src="https://ddragon.leagueoflegends.com/cdn/12.6.1/img/champion/{{ $champion['image']['full'] }}" 
                 alt="{{ $champion['name'] }}" class="champion-icon">
            <div>
                <h3 class="champion-name">{{ $champion['name'] }}</h3>
                <p class="champion-title">{{ $champion['title'] }}</p>
            </div>
        </div>
        
        <div class="champion-info">
            <div class="info-item">
                <span class="info-label">Attack:</span>
                <span class="info-value">{{ $champion['info']['attack'] }}/10</span>
            </div>
            <div class="info-item">
                <span class="info-label">Defense:</span>
                <span class="info-value">{{ $champion['info']['defense'] }}/10</span>
            </div>
            <div class="info-item">
                <span class="info-label">Magic:</span>
                <span class="info-value">{{ $champion['info']['magic'] }}/10</span>
            </div>
            <div class="info-item">
                <span class="info-label">Difficulty:</span>
                <span class="info-value">{{ $champion['info']['difficulty'] }}/10</span>
            </div>
        </div>

        <div class="difficulty-bar">
            <div class="difficulty-fill" style="width: {{ $champion['info']['difficulty'] * 10 }}%"></div>
        </div>

        <div class="tags">
            @foreach($champion['tags'] as $tag)
            <span class="tag">{{ $tag }}</span>
            @endforeach
        </div>

        <a href="{{ route('champions.show', $champion['id']) }}" class="btn btn-block">
            View Details <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    @endforeach
</div>
@endsection