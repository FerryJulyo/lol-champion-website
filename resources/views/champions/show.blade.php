@extends('layouts.app')

@section('title', $champion['name'])

@section('content')

<div class="container mx-auto px-4 py-8">
    
    <!-- Back Button -->
    <a href="{{ route('champions.index') }}" 
       class="inline-flex items-center space-x-2 text-gray-400 hover:text-white mb-8 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        <span>Back to Champions</span>
    </a>

    <!-- Champion Header -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        
        <!-- Left: Image -->
        <div class="lg:col-span-1">
            <div class="relative rounded-3xl overflow-hidden border-4 border-slate-700 group">
                <img src="https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{{ $champion['id'] }}_0.jpg" 
                     alt="{{ $champion['name'] }}"
                     class="w-full h-auto transform group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
            </div>
        </div>

        <!-- Right: Info -->
        <div class="lg:col-span-2">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-5xl font-black mb-2 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                        {{ $champion['name'] }}
                    </h1>
                    <p class="text-2xl text-gray-400 mb-4">{{ $champion['title'] }}</p>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($champion['tags'] as $tag)
                        <span class="px-4 py-2 text-sm bg-blue-500/20 text-blue-400 rounded-full font-semibold border border-blue-500/30">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
                    <div class="text-3xl font-bold text-amber-400 mb-1">{{ $champion['info']['attack'] }}</div>
                    <div class="text-sm text-gray-400">Attack</div>
                    <div class="mt-2 h-2 bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" 
                             style="width: {{ ($champion['info']['attack'] / 10) * 100 }}%"></div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
                    <div class="text-3xl font-bold text-blue-400 mb-1">{{ $champion['info']['defense'] }}</div>
                    <div class="text-sm text-gray-400">Defense</div>
                    <div class="mt-2 h-2 bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500" 
                             style="width: {{ ($champion['info']['defense'] / 10) * 100 }}%"></div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
                    <div class="text-3xl font-bold text-purple-400 mb-1">{{ $champion['info']['magic'] }}</div>
                    <div class="text-sm text-gray-400">Magic</div>
                    <div class="mt-2 h-2 bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500" 
                             style="width: {{ ($champion['info']['magic'] / 10) * 100 }}%"></div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-4 border border-slate-700">
                    <div class="text-3xl font-bold text-pink-400 mb-1">{{ $champion['info']['difficulty'] }}</div>
                    <div class="text-sm text-gray-400">Difficulty</div>
                    <div class="mt-2 h-2 bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-pink-500 to-rose-500" 
                             style="width: {{ ($champion['info']['difficulty'] / 10) * 100 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-slate-800/30 backdrop-blur-sm rounded-2xl p-6 border border-slate-700">
                <h2 class="text-xl font-bold mb-3 flex items-center">
                    <span class="mr-2">📖</span> Lore
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    {{ $champion['blurb'] }}
                </p>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700">
            <h3 class="text-lg font-bold mb-3">🎯 Primary Role</h3>
            <p class="text-2xl font-bold text-blue-400">{{ $champion['tags'][0] ?? 'Unknown' }}</p>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700">
            <h3 class="text-lg font-bold mb-3">⚔️ Attack Type</h3>
            <p class="text-2xl font-bold text-purple-400">
                @if($champion['info']['attack'] > $champion['info']['magic'])
                    Physical
                @elseif($champion['info']['magic'] > $champion['info']['attack'])
                    Magic
                @else
                    Hybrid
                @endif
            </p>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700">
            <h3 class="text-lg font-bold mb-3">🎮 Playstyle</h3>
            <p class="text-2xl font-bold text-pink-400">
                @if($champion['info']['difficulty'] <= 3)
                    Beginner Friendly
                @elseif($champion['info']['difficulty'] <= 6)
                    Intermediate
                @else
                    Advanced
                @endif
            </p>
        </div>
    </div>

    <!-- Similar Champions -->
    @if($similarChampions->count() > 0)
    <div class="mb-12">
        <h2 class="text-3xl font-bold mb-6">Similar Champions</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($similarChampions as $similar)
            <a href="{{ route('champions.show', $similar['id']) }}" 
               class="group relative bg-slate-800/50 backdrop-blur-sm rounded-xl overflow-hidden border border-slate-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                <div class="aspect-square overflow-hidden">
                    <img src="https://ddragon.leagueoflegends.com/cdn/12.6.1/img/champion/{{ $similar['id'] }}.png" 
                         alt="{{ $similar['name'] }}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-3">
                    <h3 class="font-bold group-hover:text-blue-400 transition-colors truncate">{{ $similar['name'] }}</h3>
                    <p class="text-xs text-gray-400 truncate">{{ $similar['title'] }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush