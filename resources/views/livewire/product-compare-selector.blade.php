<div>
    <div class="min-h-screen bg-warm-white-500 {{ $this->comparedProductCount > 0 ? 'pb-20' : '' }}">

    {{-- Hero --}}
    <section class="bg-midnight-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-display font-bold tracking-tight mb-3">Select Ovens to Compare</h1>
            <p class="text-white/60 text-lg max-w-2xl">
                Choose up to 3 ovens to compare side-by-side. Browse by category or search to find the models you want to evaluate.
            </p>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('compare') }}" wire:navigate
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-button text-sm font-medium
                          bg-white/10 hover:bg-white/20 text-white border border-white/20
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Compare
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
                                    class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150
                                           {{ $categoryId === '' ? 'bg-midnight-500 text-white' : 'text-charcoal-500 hover:bg-steel-200 active:scale-[0.98]' }}">
                                All Products
                            </button>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <button wire:click="selectCategory({{ $cat->id }})"
                                        class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150
                                               {{ (string) $categoryId === (string) $cat->id ? 'bg-midnight-500 text-white' : 'text-charcoal-500 hover:bg-steel-200 active:scale-[0.98]' }}">
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
                                      focus:border-midnight-400 transition-all duration-150">
                    </div>
                    <select wire:model.live="sortBy"
                            class="px-4 py-2.5 rounded-xl border border-steel-300 bg-white text-sm text-midnight-500
                                   focus:outline-none focus:ring-2 focus:ring-midnight-500/20 focus:border-midnight-400
                                   transition-all duration-150 cursor-pointer">
                        <option value="name">Sort: Name A–Z</option>
                        <option value="sort_order">Sort: Default</option>
                    </select>
                </div>

                {{-- Max limit feedback --}}
                @if ($showLimitMessage)
                    <div x-data="{ show: @entangle('showLimitMessage') }"
                         x-show="show"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-init="setTimeout(() => $wire.set('showLimitMessage', false), 3000)"
                         class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-amber-800">Maximum 3 ovens for comparison</p>
                                <p class="text-xs text-amber-600 mt-0.5">Remove one before adding another.</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Selected compare preview --}}
                @if ($this->comparedProductCount > 0)
                    <div x-data="{ visible: @entangle('comparedProductCount') }"
                         x-show="visible > 0"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="bg-midnight-50 border border-midnight-200 rounded-xl p-4 mb-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-midnight-500 text-white text-xs font-bold">
                                    {{ $this->comparedProductCount }}
                                </span>
                                <span class="text-sm font-medium text-midnight-900">
                                    {{ $this->comparedProductCount }}/3 ovens selected
                                </span>
                            </div>
                            <a href="{{ route('compare') }}" wire:navigate
                               class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-midnight-500 text-white text-xs font-medium rounded-lg
                                      hover:bg-midnight-600 transition-all duration-150 active:scale-[0.97]">
                                Compare now
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Results count --}}
                <p class="text-sm text-charcoal-400 mb-5" wire:loading.class="opacity-50">
                    @if ($products->total() > 0)
                        {{ $products->total() }} {{ Str::plural('product', $products->total()) }} found
                        @if ($search)
                            for <span class="font-medium text-midnight-500">"{{ e($search) }}"</span>
                        @endif
                    @endif
                </p>

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
                                    class="mt-3 text-sm text-midnight-500 hover:underline transition-colors duration-150">
                                Clear filters
                            </button>
                        @endif
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6" wire:loading.class="opacity-40" wire:target="search, categoryId, sortBy">
                        @foreach ($products as $product)
                            @php $isSelected = in_array($product->id, $comparedProductIds); @endphp
                            <div class="group bg-white rounded-2xl border overflow-hidden
                                        transition-all duration-200 ease-out flex flex-col
                                        {{ $isSelected
                                            ? 'border-midnight-500 ring-2 ring-midnight-500/30 shadow-md'
                                            : 'border-steel-300 hover:border-midnight-300 hover:shadow-lg' }}">

                                {{-- Product Image --}}
                                <a href="/products/{{ $product->slug }}" class="block relative aspect-[4/3] bg-ice-200 overflow-hidden">
                                    @if ($product->list_image)
                                        <img src="{{ $product->list_image }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300"
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
                                    @elseif ($product->configurator_image)
                                        <img src="{{ $product->configurator_image }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300"
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
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

                                    {{-- Selected badge with fade transition --}}
                                    <div x-show="{{ $isSelected ? 'true' : 'false' }}" x-cloak
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-75"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="absolute top-3 right-3 text-xs font-medium px-2.5 py-1 rounded-full bg-midnight-500 text-white shadow-sm">
                                        Selected
                                    </div>
                                </a>

                                {{-- Product Info --}}
                                <div class="p-5 flex flex-col flex-1">
                                    <h3 class="font-display font-semibold text-midnight-500 text-base leading-snug mb-1">
                                        <a href="/products/{{ $product->slug }}" class="hover:underline transition-colors duration-150">
                                            {{ $product->name }}
                                        </a>
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

                                    {{-- Spacer pushes actions to bottom --}}
                                    <div class="flex-1"></div>

                                    {{-- Actions --}}
                                    <div class="flex items-center gap-2">
                                        <a href="/products/{{ $product->slug }}"
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium
                                                  bg-midnight-500 text-white hover:bg-midnight-400
                                                  transition-all duration-150 active:scale-[0.97]">
                                            View Details
                                        </a>
                                        <button wire:click="toggleCompare({{ $product->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="toggleCompare({{ $product->id }})"
                                           class="inline-flex items-center justify-center w-9 h-9 rounded-lg
                                                  transition-all duration-200 active:scale-[0.95]
                                                  {{ $isSelected
                                                      ? 'bg-midnight-500 text-white hover:bg-midnight-600 shadow-sm'
                                                      : 'border border-steel-300 text-charcoal-500 hover:border-midnight-400 hover:text-midnight-500 hover:bg-midnight-50' }}
                                                  disabled:opacity-60 disabled:cursor-wait"
                                           title="{{ $isSelected ? 'Remove from compare' : 'Add to compare' }}">
                                            <span wire:loading.remove wire:target="toggleCompare({{ $product->id }})">
                                                @if ($isSelected)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                    </svg>
                                                @endif
                                            </span>
                                            <span wire:loading wire:target="toggleCompare({{ $product->id }})">
                                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                                </svg>
                                            </span>
                                        </button>
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

{{-- Sticky Compare Bar --}}
@if ($this->comparedProductCount > 0)
    <div x-data
         x-show="{{ $this->comparedProductCount }} > 0"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-slate-200 shadow-lg shadow-slate-900/5">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-midnight-500 text-white text-sm font-bold">
                    {{ $this->comparedProductCount }}
                </span>
                <span class="text-sm font-medium text-slate-700">
                    {{ $this->comparedProductCount === 1 ? '1 oven' : $this->comparedProductCount . ' ovens' }} selected for comparison
                </span>
            </div>
            <a href="{{ route('compare') }}" wire:navigate
                class="px-5 py-2.5 bg-midnight-500 text-white rounded-lg font-semibold text-sm
                       hover:bg-midnight-600 transition-all duration-150 active:scale-[0.97] flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
                Compare
            </a>
        </div>
    </div>
@endif
</div>
