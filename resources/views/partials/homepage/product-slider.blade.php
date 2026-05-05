<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($section->title)
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4">{{ $section->title }}</h2>
        @endif
        @if ($section->subtitle)
            <p class="text-gray-500 text-center mb-12 max-w-2xl mx-auto">{{ $section->subtitle }}</p>
        @endif

        @php
            $products = $section->products();
            $maxItems = $section->content['max_items'] ?? 8;
            $showBadges = $section->content['show_energy_badges'] ?? false;
        @endphp

        @if ($products->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products->take($maxItems) as $product)
                    <div class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center overflow-hidden">
                            @php $image = $product->images()->first(); @endphp
                            @if ($image)
                                <img src="{{ asset('storage/' . $image->path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $product->type }}</p>
                            <h3 class="font-semibold mt-1 mb-2">{{ $product->name }}</h3>
                            @if ($showBadges && ($product->consumption_kwh || $product->co2_emission))
                                <div class="flex gap-3 text-xs text-gray-500">
                                    @if ($product->consumption_kwh)
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            {{ $product->consumption_kwh }} kWh/day
                                        </span>
                                    @endif
                                    @if ($product->co2_emission)
                                        <span>{{ $product->co2_emission }} kg CO₂/day</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($section->cta_text && $section->cta_url)
            <div class="text-center mt-10">
                <a href="{{ url($section->cta_url) }}"
                   class="inline-block bg-gray-900 text-white px-6 py-3 rounded-md font-medium hover:bg-gray-800 transition-colors">
                    {{ $section->cta_text }}
                </a>
            </div>
        @endif
    </div>
</section>
