<section class="py-16 lg:py-24 bg-warm-white-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($section->title)
            <h2 class="font-display font-bold text-4xl lg:text-5xl text-midnight-500 text-center mb-4">{{ $section->title }}</h2>
        @endif
        @if ($section->subtitle)
            <p class="text-charcoal-400 text-center mb-14 max-w-2xl mx-auto text-lg leading-relaxed">{{ $section->subtitle }}</p>
        @endif

        @php
            $products = $section->products();
            $maxItems = $section->content['max_items'] ?? 8;
            $showBadges = $section->content['show_energy_badges'] ?? false;
        @endphp

        @if ($products->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products->take($maxItems) as $product)
                    <div class="group bg-white rounded-card border border-steel-500/50 overflow-hidden
                                transition-all duration-300 hover:-translate-y-1
                                hover:shadow-xl hover:shadow-midnight-500/5">
                        <div class="aspect-[4/3] bg-ice-500 flex items-center justify-center overflow-hidden">
                            @php $image = $product->images()->first(); @endphp
                            @if ($image)
                                <img src="{{ asset('storage/' . $image->path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
                            @else
                                <div class="text-steel-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <p class="text-xs text-charcoal-300 uppercase tracking-wide font-semibold">{{ $product->type }}</p>
                            <h3 class="font-display font-bold text-lg text-midnight-500 mt-1.5 mb-3">{{ $product->name }}</h3>
                            @if ($showBadges && ($product->consumption_kwh || $product->co2_emission))
                                <div class="flex flex-wrap gap-3 text-xs text-charcoal-400">
                                    @if ($product->consumption_kwh)
                                        <span class="inline-flex items-center gap-1 bg-midnight-500/5 rounded-full px-2.5 py-1">
                                            <svg class="w-3.5 h-3.5 text-midnight-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            {{ $product->consumption_kwh }} kWh/day
                                        </span>
                                    @endif
                                    @if ($product->co2_emission)
                                        <span class="inline-flex items-center gap-1 bg-midnight-500/5 rounded-full px-2.5 py-1">
                                            {{ $product->co2_emission }} kg CO₂/day
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-charcoal-300">
                <p>No products selected. Configure this section in the admin panel.</p>
            </div>
        @endif

        @if ($section->cta_text && $section->cta_url)
            <div class="text-center mt-12">
                <a href="{{ url($section->cta_url) }}"
                   class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                          bg-midnight-500 text-white hover:bg-charcoal-600
                          transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                    {{ $section->cta_text }}
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
