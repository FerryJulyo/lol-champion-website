@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">SEARCH RESULTS</h1>
    <p class="page-subtitle">Found {{ count($results) }} results for "{{ $query }}"</p>
</div>

@if(count($results) > 0)
<div class="champions-grid">
    @foreach($results as $champion)
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
@else
<div style="text-align: center; padding: 4rem;">
    <i class="fas fa-search" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
    <h3 style="color: var(--text-muted); margin-bottom: 1rem;">No champions found</h3>
    <p style="color: var(--text-muted);">Try searching with different keywords</p>
    <a href="{{ route('champions.index') }}" class="btn" style="margin-top: 1rem;">
        <i class="fas fa-arrow-left"></i> Back to All Champions
    </a>
</div>
@endif
@endsection