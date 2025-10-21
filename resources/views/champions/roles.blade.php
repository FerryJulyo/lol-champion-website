@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">CHAMPION ROLES</h1>
    <p class="page-subtitle">Browse champions by their primary roles</p>
</div>

@foreach($roles as $role => $champions)
<div class="role-section">
    <h2 class="role-title">{{ $role }}</h2>
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
</div>
@endforeach
@endsection