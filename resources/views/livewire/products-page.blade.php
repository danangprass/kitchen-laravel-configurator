<div class="min-h-screen bg-warm-white-500">

    {{-- Hero --}}
    <section class="bg-midnight-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-display font-bold tracking-tight mb-3">All Products</h1>
            <p class="text-white/60 text-lg max-w-2xl">
                Browse our full range of commercial kitchen solutions. Filter by category or search to find the right oven for your operation.
            </p>
            <div class="mt-6 flex gap-3">
                <a href="/compare"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-button text-sm font-medium
                          bg-white/10 hover:bg-white/20 text-white border border-white/20
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Compare Products
                </a>
                <a href="/configurator"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-button text-sm font-medium
                          bg-white text-midnight-500 hover:bg-white/90 hover:scale-[1.02]
                          transition-all duration-200 shadow-sm">
                    Build Your Own
                </a>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Sidebar — Category Filters --}}
            <aside class="lg:w-56 shrink-0">
                <div class="bg-white rounded-2xl border border-steel-300 p-5 sticky top-24">
                    <h2 class="text-sm font-semibold text-midnight-500 uppercase tracking-wider mb-4">Category</h2>
                    <ul class="space-y-1">
                        <li>
                            <button wire:click="selectCategory('')"
                                    class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                                           {{ $categoryId === '' ? 'bg-midnight-500 text-white' : 'text-charcoal-500 hover:bg-steel-200' }}">
                                All Products
                            </button>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <button wire:click="selectCategory({{ $cat->id }})"
                                        class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                                               {{ (string) $categoryId === (string) $cat->id ? 'bg-midnight-500 text-white' : 'text-charcoal-500 hover:bg-steel-200' }}">
                                    {{ $cat->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Main --}}
            <div class="flex-1 min-w-0">

                {{-- Search & Sort bar --}}
                <div class="flex flex-col sm:flex-row gap-3 mb-6">
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-charcoal-400 pointer-events-none"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input wire:model.live.debounce.300ms="search"
                               type="search"
                               placeholder="Search products…"
                               class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-steel-300 bg-white text-sm text-midnight-500
                                      placeholder:text-charcoal-400 focus:outline-none focus:ring-2 focus:ring-midnight-500/20
                                      focus:border-midnight-400 transition-colors duration-150">
                    </div>
                    <select wire:model.live="sortBy"
                            class="px-4 py-2.5 rounded-xl border border-steel-300 bg-white text-sm text-midnight-500
                                   focus:outline-none focus:ring-2 focus:ring-midnight-500/20 focus:border-midnight-400
                                   transition-colors duration-150">
                        <option value="name">Sort: Name A–Z</option>
                        <option value="sort_order">Sort: Default</option>
                    </select>
                </div>

                {{-- Results count --}}
                <p class="text-sm text-charcoal-400 mb-5" wire:loading.class="opacity-50">
                    {{ $products->total() }} {{ Str::plural('product', $products->total()) }} found
                    @if ($search)
                        for <span class="font-medium text-midnight-500">"{{ $search }}"</span>
                    @endif
                </p>

                {{-- Loading overlay --}}
                <div wire:loading.flex class="items-center justify-center py-16">
                    <svg class="w-8 h-8 animate-spin text-midnight-300" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                </div>

                {{-- Product Grid --}}
                @if ($products->isEmpty())
                    <div class="text-center py-20">
                        <svg class="w-12 h-12 mx-auto text-steel-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-charcoal-400 text-sm">No products found.</p>
                        @if ($search || $categoryId !== '')
                            <button wire:click="$set('search', ''); $set('categoryId', '')"
                                    class="mt-3 text-sm text-midnight-500 hover:underline">
                                Clear filters
                            </button>
                        @endif
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6" wire:loading.class="opacity-40">
                        @foreach ($products as $product)
                            <div class="group bg-white rounded-2xl border border-steel-300 overflow-hidden
                                        hover:border-midnight-300 hover:shadow-lg transition-all duration-200">

                                {{-- Product Image --}}
                                <div class="relative aspect-[4/3] bg-ice-200 overflow-hidden">
                                    @if ($product->list_image)
                                        <img src="{{ $product->list_image }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                                    @elseif ($product->configurator_image)
                                        <img src="{{ $product->configurator_image }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-steel-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    @if ($product->category)
                                        <span class="absolute top-3 left-3 text-xs font-medium px-2.5 py-1 rounded-full
                                                     bg-midnight-500/80 text-white backdrop-blur-sm">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="p-5">
                                    <h3 class="font-display font-semibold text-midnight-500 text-base leading-snug mb-1">
                                        {{ $product->name }}
                                    </h3>

                                    @if ($product->sku)
                                        <p class="text-xs text-charcoal-400 mb-2">SKU: {{ $product->sku }}</p>
                                    @endif

                                    @if ($product->short_description)
                                        <p class="text-sm text-charcoal-500 leading-relaxed line-clamp-2 mb-4">
                                            {{ $product->short_description }}
                                        </p>
                                    @endif

                                    {{-- Quick specs --}}
                                    @if ($product->width || $product->number_of_trays)
                                        <div class="flex flex-wrap gap-x-4 gap-y-1 mb-4">
                                            @if ($product->number_of_trays)
                                                <span class="text-xs text-charcoal-400">
                                                    {{ $product->number_of_trays }} tray{{ $product->number_of_trays > 1 ? 's' : '' }}
                                                </span>
                                            @endif
                                            @if ($product->width)
                                                <span class="text-xs text-charcoal-400">
                                                    {{ $product->width }}cm wide
                                                </span>
                                            @endif
                                            @if ($product->type)
                                                <span class="text-xs text-charcoal-400 capitalize">
                                                    {{ $product->type }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- Actions --}}
                                    <div class="flex items-center gap-2">
                                        <a href="/configurator"
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium
                                                  bg-midnight-500 text-white hover:bg-midnight-400
                                                  transition-colors duration-150">
                                            Configure
                                        </a>
                                        <a href="/compare"
                                           class="inline-flex items-center justify-center px-3 py-2 rounded-lg text-sm font-medium
                                                  border border-steel-300 text-charcoal-500 hover:border-midnight-300 hover:text-midnight-500
                                                  transition-colors duration-150"
                                           title="Compare">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($products->hasPages())
                        <div class="mt-10">
                            {{ $products->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
