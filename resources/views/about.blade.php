@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">ABOUT PROJECT</h1>
    <p class="page-subtitle">League of Legends Champions Database</p>
</div>

<div style="max-width: 800px; margin: 0 auto;">
    <div style="background: rgba(26, 26, 46, 0.8); border-radius: 15px; padding: 2rem; margin-bottom: 2rem;">
        <h3 style="color: var(--accent); margin-bottom: 1rem; font-family: 'Orbitron', sans-serif;">Project Overview</h3>
        <p style="line-height: 1.6; margin-bottom: 1rem;">
            This is a futuristic web application built with Laravel that displays League of Legends champion data 
            from the official Riot Games Data Dragon API. The application features a modern, cyberpunk-inspired 
            design with smooth animations and responsive layout.
        </p>
        <p style="line-height: 1.6;">
            All champion data is fetched in real-time from Riot's API and includes detailed information about 
            each champion's abilities, stats, lore, and more.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <div style="background: rgba(26, 26, 46, 0.8); border-radius: 10px; padding: 1.5rem; text-align: center;">
            <i class="fas fa-rocket" style="font-size: 2rem; color: var(--accent); margin-bottom: 1rem;"></i>
            <h4 style="color: var(--accent); margin-bottom: 0.5rem;">Futuristic Design</h4>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Cyberpunk-inspired UI with glowing effects and modern animations</p>
        </div>
        
        <div style="background: rgba(26, 26, 46, 0.8); border-radius: 10px; padding: 1.5rem; text-align: center;">
            <i class="fas fa-mobile-alt" style="font-size: 2rem; color: var(--accent); margin-bottom: 1rem;"></i>
            <h4 style="color: var(--accent); margin-bottom: 0.5rem;">Responsive</h4>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Fully responsive design that works on all devices</p>
        </div>
        
        <div style="background: rgba(26, 26, 46, 0.8); border-radius: 10px; padding: 1.5rem; text-align: center;">
            <i class="fas fa-bolt" style="font-size: 2rem; color: var(--accent); margin-bottom: 1rem;"></i>
            <h4 style="color: var(--accent); margin-bottom: 0.5rem;">Fast Loading</h4>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Optimized performance with caching and efficient data handling</p>
        </div>
    </div>

    <div style="background: rgba(26, 26, 46, 0.8); border-radius: 15px; padding: 2rem;">
        <h3 style="color: var(--accent); margin-bottom: 1rem; font-family: 'Orbitron', sans-serif;">Features</h3>
        <ul style="color: var(--text); line-height: 1.6; list-style-type: none;">
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check" style="color: var(--success); margin-right: 0.5rem;"></i> Browse all League of Legends champions</li>
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check" style="color: var(--success); margin-right: 0.5rem;"></i> View detailed champion information and abilities</li>
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check" style="color: var(--success); margin-right: 0.5rem;"></i> Filter champions by roles and difficulty</li>
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check" style="color: var(--success); margin-right: 0.5rem;"></i> Advanced search functionality</li>
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check" style="color: var(--success); margin-right: 0.5rem;"></i> Responsive grid layout with hover effects</li>
            <li><i class="fas fa-check" style="color: var(--success); margin-right: 0.5rem;"></i> Real-time data from Riot Games API</li>
        </ul>
    </div>
</div>
@endsection