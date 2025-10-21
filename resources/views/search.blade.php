@extends('layouts.app')

@section('title', 'Search Champions')

@section('content')

<div class="container mx-auto px-4 py-8" x-data="searchChampions()">
    
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">
            <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                Search Champions
            </span>
        </h1>
        <p class="text-gray-400 text-lg">Find your perfect champion with advanced filters</p>
    </div>

    <!-- Search Box -->
    <div class="max-w-4xl mx-auto mb-8">
        <div class="relative">
            <input type="text" 
                   x-model="searchQuery"
                   @input.debounce.500ms="performSearch()"
                   placeholder="Search champions by name or title..."
                   class="w-full px-6 py-5 pr-14 bg-slate-800/50 backdrop-blur-sm border-2 border-slate-700 rounded-2xl focus:outline-none focus:border-blue-500 transition-all text-lg">
            <div class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Advanced Filters -->
    <div class="max-w-4xl mx-auto mb-8">
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-700">
            <div class="flex items-center justify-between mb-4 cursor-pointer" @click="showFilters = !showFilters">
                <h3 class="text-lg font-semibold">Advanced Filters</h3>
                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': showFilters }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
            
            <div x-show="showFilters" x-transition class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Role Filter -->
                <div>
                    <label class="block text-sm font-medium mb-2">Role</label>
                    <select x-model="filters.role" 
                            @change="performSearch()"
                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Difficulty Filter -->
                <div>
                    <label class="block text-sm font-medium mb-2">Difficulty</label>
                    <select x-model="filters.difficulty" 
                            @change="performSearch()"
                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="">All Difficulties</option>
                        <option value="1">1 - Very Easy</option>
                        <option value="2">2 - Easy</option>
                        <option value="3">3 - Easy</option>
                        <option value="4">4 - Moderate</option>
                        <option value="5">5 - Moderate</option>
                        <option value="6">6 - Moderate</option>
                        <option value="7">7 - Hard</option>
                        <option value="8">8 - Hard</option>
                        <option value="9">9 - Very Hard</option>
                        <option value="10">10 - Very Hard</option>
                    </select>
                </div>

                <!-- Attack Type Filter -->
                <div>
                    <label class="block text-sm font-medium mb-2">Attack Type</label>
                    <select x-model="filters.attackType" 
                            @change="performSearch()"
                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="">All Types</option>
                        <option value="physical">Physical</option>
                        <option value="magic">Magic</option>
                    </select>
                </div>
            </div>

            <button @click="resetFilters()" 
                    class="mt-4 px-4 py-2 bg-slate-700 rounded-lg hover:bg-slate-600 transition-colors text-sm">
                Reset Filters
            </button>
        </div>
    </div>

    <!-- Loading State -->
    <div x-show="loading" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent"></div>
        <p class="text-gray-400 mt-4">Searching...</p>
    </div>

    <!-- Results Count -->
    <div x-show="!loading && searchResults.length > 0" class="max-w-4xl mx-auto mb-6">
        <p class="text-gray-400">
            Found <span class="text-white font-semibold" x-text="searchResults.length"></span> champions
        </p>
    </div>

    <!-- Search Results -->
    <div x-show="!loading && searchResults.length > 0" 
         class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6 max-w-7xl mx-auto mb-8">
        <template x-for="champion in searchResults" :key="champion.id">
            <a :href="`/champions/${champion.id}`" 
               class="group relative bg-slate-800/50 backdrop-blur-sm rounded-2xl overflow-hidden border border-slate-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20">
                
                <!-- Champion Image -->
                <div class="aspect-square overflow-hidden relative">
                    <img :src="`https://ddragon.leagueoflegends.com/cdn/12.6.1/img/champion/${champion.id}.png`" 
                         :alt="champion.name"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    
                    <!-- Difficulty Badge -->
                    <div class="absolute top-2 right-2 px-2 py-1 bg-slate-900/80 backdrop-blur-sm rounded-lg text-xs font-semibold">
                        <span x-text="champion.info.difficulty"></span>/10
                    </div>
                </div>
                
                <!-- Champion Info -->
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-1 group-hover:text-blue-400 transition-colors truncate" x-text="champion.name"></h3>
                    <p class="text-xs text-gray-400 mb-3 truncate" x-text="champion.title"></p>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-1 mb-3">
                        <template x-for="tag in champion.tags" :key="tag">
                            <span class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded-full" x-text="tag"></span>
                        </template>
                    </div>
                    
                    <!-- Stats Mini -->
                    <div class="grid grid-cols-3 gap-2 text-xs">
                        <div class="text-center">
                            <div class="text-amber-400 font-bold" x-text="champion.info.attack"></div>
                            <div class="text-gray-500">ATK</div>
                        </div>
                        <div class="text-center">
                            <div class="text-blue-400 font-bold" x-text="champion.info.defense"></div>
                            <div class="text-gray-500">DEF</div>
                        </div>
                        <div class="text-center">
                            <div class="text-purple-400 font-bold" x-text="champion.info.magic"></div>
                            <div class="text-gray-500">MAG</div>
                        </div>
                    </div>
                </div>
            </a>
        </template>
    </div>

    <!-- No Results -->
    <div x-show="!loading && searchQuery && searchResults.length === 0" class="text-center py-20">
        <div class="text-6xl mb-4">😢</div>
        <h3 class="text-2xl font-bold mb-2">No Champions Found</h3>
        <p class="text-gray-400 mb-6">Try adjusting your search query or filters</p>
    </div>

    <!-- Initial State -->
    <div x-show="!loading && !searchQuery && searchResults.length === 0" class="text-center py-20">
        <div class="text-6xl mb-4">🔍</div>
        <h3 class="text-2xl font-bold mb-2">Start Searching</h3>
        <p class="text-gray-400">Enter a champion name or use filters to find champions</p>
    </div>

</div>

@endsection

@push('scripts')
<script>
function searchChampions() {
    return {
        searchQuery: '{{ $query }}',
        searchResults: @json($results),
        loading: false,
        showFilters: false,
        filters: {
            role: '',
            difficulty: '',
            attackType: ''
        },

        init() {
            if (this.searchQuery) {
                this.performSearch();
            }
        },

        async performSearch() {
            if (!this.searchQuery && !this.filters.role && !this.filters.difficulty && !this.filters.attackType) {
                this.searchResults = [];
                return;
            }

            this.loading = true;

            try {
                const params = new URLSearchParams({
                    q: this.searchQuery,
                    role: this.filters.role,
                    difficulty: this.filters.difficulty,
                    attack_type: this.filters.attackType
                });

                const response = await fetch(`/api/search?${params.toString()}`);
                const data = await response.json();
                
                if (data.success) {
                    this.searchResults = data.data;
                }
            } catch (error) {
                console.error('Search error:', error);
            } finally {
                this.loading = false;
            }
        },

        resetFilters() {
            this.searchQuery = '';
            this.filters = {
                role: '',
                difficulty: '',
                attackType: ''
            };
            this.searchResults = [];
        }
    }
}
</script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush