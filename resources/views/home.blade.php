@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<section class="relative py-20 lg:py-32 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl lg:text-7xl font-black mb-6 leading-tight">
                <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient">
                    League of Legends
                </span>
                <br>
                <span class="text-white">Champions Portal</span>
            </h1>
            <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto">
                Explore {{ $totalChampions }}+ champions with detailed stats, abilities, and lore. 
                Discover your next main champion today.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('champions.index') }}" 
                   class="px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl font-semibold hover:shadow-2xl hover:shadow-blue-500/50 transform hover:-translate-y-1 transition-all duration-300">
                    Explore Champions
                </a>
                <a href="{{ route('search.index') }}" 
                   class="px-8 py-4 bg-slate-800 rounded-xl font-semibold hover:bg-slate-700 transform hover:-translate-y-1 transition-all duration-300">
                    🔍 Advanced Search
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats -->
<section class="py-12 border-y border-slate-800 bg-slate-900/30">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent mb-2">
                    {{ $totalChampions }}+
                </div>
                <div class="text-gray-400 text-sm">Total Champions</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-purple-600 bg-clip-text text-transparent mb-2">
                    {{ count($roles) }}
                </div>
                <div class="text-gray-400 text-sm">Unique Roles</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold bg-gradient-to-r from-pink-400 to-pink-600 bg-clip-text text-transparent mb-2">
                    5
                </div>
                <div class="text-gray-400 text-sm">Menu Features</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent mb-2">
                    100%
                </div>
                <div class="text-gray-400 text-sm">Up to Date</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Champions -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold mb-2">Featured Champions</h2>
                <p class="text-gray-400">Top champions with the highest combined stats</p>
            </div>
            <a href="{{ route('champions.index') }}" 
               class="px-6 py-3 bg-slate-800 rounded-lg hover:bg-slate-700 transition-colors text-sm font-medium">
                View All →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredChampions as $champion)
            <a href="{{ route('champions.show', $champion['id']) }}" 
               class="group relative bg-slate-800/50 backdrop-blur-sm rounded-2xl overflow-hidden border border-slate-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20">
                
                <!-- Champion Image -->
                <div class="aspect-square overflow-hidden">
                    <img src="https://ddragon.leagueoflegends.com/cdn/12.6.1/img/champion/{{ $champion['id'] }}.png" 
                         alt="{{ $champion['name'] }}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                
                <!-- Champion Info -->
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-1 group-hover:text-blue-400 transition-colors">
                        {{ $champion['name'] }}
                    </h3>
                    <p class="text-sm text-gray-400 mb-3">{{ $champion['title'] }}</p>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($champion['tags'] as $tag)
                        <span class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded-full">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="flex items-center space-x-1">
                            <span class="text-gray-400">Attack:</span>
                            <div class="flex">
                                @for($i = 0; $i < $champion['info']['attack']; $i++)
                                <span class="text-amber-400">★</span>
                                @endfor
                            </div>
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-gray-400">Magic:</span>
                            <div class="flex">
                                @for($i = 0; $i < $champion['info']['magic']; $i++)
                                <span class="text-purple-400">★</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-t from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/10 group-hover:to-transparent transition-all duration-300 pointer-events-none"></div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-slate-900/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Powerful Features</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Everything you need to explore and discover League of Legends champions
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700 hover:border-blue-500 transition-all">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-2xl">🔍</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Advanced Search</h3>
                <p class="text-gray-400 text-sm">
                    Find champions instantly with powerful filters and real-time search
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700 hover:border-purple-500 transition-all">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-2xl">📊</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Detailed Statistics</h3>
                <p class="text-gray-400 text-sm">
                    Analyze champion data with interactive charts and visualizations
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700 hover:border-pink-500 transition-all">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-amber-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-2xl">🎭</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Complete Database</h3>
                <p class="text-gray-400 text-sm">
                    Access full champion roster with stats, abilities, and lore
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700 hover:border-amber-500 transition-all">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-2xl">📱</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Fully Responsive</h3>
                <p class="text-gray-400 text-sm">
                    Perfect experience across all devices - desktop, tablet, and mobile
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700 hover:border-green-500 transition-all">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-2xl">⚡</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Lightning Fast</h3>
                <p class="text-gray-400 text-sm">
                    Optimized performance with caching and lazy loading
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700 hover:border-cyan-500 transition-all">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-2xl">🎨</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Modern Design</h3>
                <p class="text-gray-400 text-sm">
                    Futuristic UI with glassmorphism and smooth animations
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10">
                <h2 class="text-3xl lg:text-5xl font-bold mb-4">Ready to Explore?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Dive into the world of League of Legends champions and discover your perfect match
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('champions.index') }}" 
                       class="px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transform hover:-translate-y-1 transition-all duration-300">
                        Browse All Champions
                    </a>
                    <a href="{{ route('statistics') }}" 
                       class="px-8 py-4 bg-blue-900/50 backdrop-blur-sm text-white rounded-xl font-semibold hover:bg-blue-900/70 transform hover:-translate-y-1 transition-all duration-300">
                        View Statistics
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    @keyframes gradient {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 3s ease infinite;
    }
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush