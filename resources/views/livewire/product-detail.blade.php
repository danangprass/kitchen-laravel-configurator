<div class="min-h-screen bg-warm-white-500">

    {{-- Breadcrumb --}}
    <div class="border-b border-steel-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3" aria-label="Breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-charcoal-400">
                <li><a href="/" class="hover:text-midnight-500 transition-colors">Home</a></li>
                <li><span class="select-none">/</span></li>
                <li><a href="/products" class="hover:text-midnight-500 transition-colors">Products</a></li>
                @if ($product->category)
                    @if ($product->category->parent)
                        <li><span class="select-none">/</span></li>
                        <li><a href="/products?category={{ $product->category->parent->id }}" class="hover:text-midnight-500 transition-colors">{{ $product->category->parent->name }}</a></li>
                    @endif
                    <li><span class="select-none">/</span></li>
                    <li><a href="/products?category={{ $product->category->id }}" class="hover:text-midnight-500 transition-colors">{{ $product->category->name }}</a></li>
                @endif
                <li><span class="select-none">/</span></li>
                <li class="text-midnight-500 font-medium truncate max-w-[200px]">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    {{-- Product Hero --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

            {{-- Image Gallery --}}
            <div class="lg:w-7/12">
                @php
                    $images = $product->productImages;
                    $primaryImage = $images->where('is_primary', true)->first() ?? $images->first();
                    $videoEmbed = App\Livewire\ProductDetail::getVideoEmbedUrl($product->video_url);
                @endphp

                {{-- Main Image --}}
                <div class="relative aspect-[4/3] bg-ice-200 rounded-2xl overflow-hidden">
                    @if ($primaryImage)
                        <img src="{{ asset('storage/' . $primaryImage->image_path) }}"
                             alt="{{ $primaryImage->alt_text ?? $product->name }}"
                             class="w-full h-full object-contain p-6"
                             id="product-main-image">
                    @elseif ($product->configurator_image)
                        <img src="{{ $product->configurator_image }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain p-6"
                             onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
                    @elseif ($product->list_image)
                        <img src="{{ $product->list_image }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain p-6"
                             onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-steel-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    @if ($product->energy_star_certified)
                        <span class="absolute top-4 right-4 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                                     bg-green-100 text-green-800 text-xs font-semibold border border-green-200">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Energy Star Certified
                        </span>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if ($images->count() > 1)
                    <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                        @foreach ($images as $image)
                            <button onclick="document.getElementById('product-main-image').src='{{ asset('storage/' . $image->image_path) }}'; document.getElementById('product-main-image').alt='{{ $image->alt_text ?? $product->name }}'"
                                    class="shrink-0 w-20 h-20 rounded-xl border-2 overflow-hidden bg-ice-200
                                           {{ $image->is_primary ? 'border-midnight-500' : 'border-steel-300 hover:border-midnight-300' }}
                                           transition-colors duration-150">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="{{ $image->alt_text ?? $product->name }}"
                                     class="w-full h-full object-contain p-1.5">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="lg:w-5/12">
                @if ($product->category)
                    <p class="text-sm font-medium text-charcoal-400 uppercase tracking-wide mb-2">
                        {{ $product->category->name }}
                    </p>
                @endif

                <h1 class="text-3xl lg:text-4xl font-display font-bold text-midnight-500 tracking-tight mb-2">
                    {{ $product->name }}
                </h1>

                @if ($product->line)
                    <p class="text-sm text-charcoal-400 mb-3">{{ $product->line }} Series</p>
                @endif

                @if ($product->sku)
                    <p class="text-xs text-charcoal-400 mb-4">SKU: {{ $product->sku }}</p>
                @endif

                @if ($product->short_description)
                    <p class="text-body text-charcoal-500 leading-relaxed mb-6">
                        {{ $product->short_description }}
                    </p>
                @endif

                {{-- Key Specs at a Glance --}}
                <div class="grid grid-cols-2 gap-3 mb-6">
                    @if ($product->type)
                        <div class="bg-ice-200 rounded-xl p-3">
                            <p class="text-xs text-charcoal-400 uppercase tracking-wide">Type</p>
                            <p class="text-sm font-semibold text-midnight-500 capitalize">{{ $product->type }}</p>
                        </div>
                    @endif
                    @if ($product->number_of_trays)
                        <div class="bg-ice-200 rounded-xl p-3">
                            <p class="text-xs text-charcoal-400 uppercase tracking-wide">Trays</p>
                            <p class="text-sm font-semibold text-midnight-500">{{ $product->number_of_trays }} @if ($product->tray_size)({{ $product->tray_size }})@endif</p>
                        </div>
                    @endif
                    @if ($product->width && $product->depth && $product->height)
                        <div class="bg-ice-200 rounded-xl p-3">
                            <p class="text-xs text-charcoal-400 uppercase tracking-wide">Dimensions (W×D×H)</p>
                            <p class="text-sm font-semibold text-midnight-500">{{ $product->width }} × {{ $product->depth }} × {{ $product->height }} cm</p>
                        </div>
                    @endif
                    @if ($product->power_supply)
                        <div class="bg-ice-200 rounded-xl p-3">
                            <p class="text-xs text-charcoal-400 uppercase tracking-wide">Power</p>
                            <p class="text-sm font-semibold text-midnight-500">{{ $product->power_supply }}</p>
                        </div>
                    @endif
                </div>

                @if ($product->price)
                    <p class="text-2xl font-display font-bold text-midnight-500 mb-6">
                        ${{ number_format($product->price, 2) }}
                    </p>
                @endif

                {{-- CTAs --}}
                <div class="flex flex-wrap gap-3">
                    <a href="/configurator?product={{ $product->id }}"
                       class="btn-pill-primary inline-flex items-center gap-2 px-6 py-3 rounded-button text-sm font-semibold
                              bg-midnight-500 text-white hover:bg-midnight-400 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                        </svg>
                        Configure This Product
                    </a>
                    <button wire:click="addToCompare({{ $product->id }})"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-button text-sm font-semibold
                                   border-2 transition-all duration-200
                                   {{ in_array($product->id, $this->comparedProductIds) ? 'border-midnight-500 bg-midnight-500 text-white' : 'border-steel-300 text-charcoal-500 hover:border-midnight-300 hover:text-midnight-500' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        {{ in_array($product->id, $this->comparedProductIds) ? 'Added to Compare' : 'Add to Compare' }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Description --}}
    @if ($product->description)
        <section class="bg-white border-y border-steel-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <h2 class="text-2xl font-display font-bold text-midnight-500 mb-6">Overview</h2>
                <div class="prose prose-lg max-w-none text-charcoal-500 leading-relaxed">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        </section>
    @endif

    {{-- Full Technical Specifications --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <h2 class="text-2xl font-display font-bold text-midnight-500 mb-8">Technical Specifications</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
            @if ($product->width)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Width</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->width }} cm</span>
                </div>
            @endif
            @if ($product->depth)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Depth</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->depth }} cm</span>
                </div>
            @endif
            @if ($product->height)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Height</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->height }} cm</span>
                </div>
            @endif
            @if ($product->weight)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Weight</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->weight }} kg</span>
                </div>
            @endif
            @if ($product->number_of_trays)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Number of Trays</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->number_of_trays }}</span>
                </div>
            @endif
            @if ($product->tray_size)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Tray Size</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->tray_size }}</span>
                </div>
            @endif
            @if ($product->distance_between_trays)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Tray Spacing</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->distance_between_trays }} mm</span>
                </div>
            @endif
            @if ($product->voltage)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Voltage</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->voltage }}</span>
                </div>
            @endif
            @if ($product->electric_power)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Electric Power</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->electric_power }} kW</span>
                </div>
            @endif
            @if ($product->max_gas_power)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Max Gas Power</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->max_gas_power }} kW</span>
                </div>
            @endif
            @if ($product->frequency)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Frequency</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->frequency }}</span>
                </div>
            @endif
            @if ($product->power_supply)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Power Supply</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->power_supply }}</span>
                </div>
            @endif
            @if ($product->type)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Type</span>
                    <span class="text-sm font-semibold text-midnight-500 capitalize">{{ $product->type }}</span>
                </div>
            @endif
            @if ($product->control_type)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Control Type</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->control_type }}</span>
                </div>
            @endif
            @if ($product->panel)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Panel</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->panel }}</span>
                </div>
            @endif
            @if ($product->opening_side)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Door Opening</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->opening_side }}</span>
                </div>
            @endif
            @if ($product->consumption_kwh)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">Consumption</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->consumption_kwh }} kWh</span>
                </div>
            @endif
            @if ($product->co2_emission)
                <div class="flex justify-between items-baseline py-2.5 border-b border-steel-200">
                    <span class="text-sm text-charcoal-400">CO₂ Emissions</span>
                    <span class="text-sm font-semibold text-midnight-500">{{ $product->co2_emission }} kg/h</span>
                </div>
            @endif
        </div>
    </section>

    {{-- Features --}}
    @if ($product->features)
        <section class="bg-ice-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <h2 class="text-2xl font-display font-bold text-midnight-500 mb-8">Key Features</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($product->features as $feature)
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-midnight-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-sm text-charcoal-500">{{ is_array($feature) ? $feature['label'] : $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Video --}}
    @if ($videoEmbed)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <h2 class="text-2xl font-display font-bold text-midnight-500 mb-8">Product Video</h2>
            <div class="relative aspect-video rounded-2xl overflow-hidden bg-midnight-500">
                <iframe src="{{ $videoEmbed }}"
                        class="absolute inset-0 w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
        </section>
    @endif

    {{-- Compatible Accessories --}}
    @php $accessories = $product->accessories; @endphp
    @if ($accessories->isNotEmpty())
        <section class="bg-white border-y border-steel-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <h2 class="text-2xl font-display font-bold text-midnight-500 mb-3">Compatible Accessories</h2>
                <p class="text-charcoal-400 mb-8">Enhance your {{ $product->name }} with these accessories.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($accessories as $accessory)
                        <div class="bg-ice-200 rounded-2xl p-5 border border-steel-300 hover:border-midnight-300 transition-colors duration-150">
                            @if ($accessory->list_image)
                                <div class="aspect-square bg-white rounded-xl overflow-hidden mb-4">
                                    <img src="{{ asset('storage/' . $accessory->list_image) }}"
                                         alt="{{ $accessory->list_image_alt ?? $accessory->name }}"
                                         class="w-full h-full object-contain p-3">
                                </div>
                            @endif
                            <h3 class="font-display font-semibold text-midnight-500 mb-1">{{ $accessory->name }}</h3>
                            @if ($accessory->sku)
                                <p class="text-xs text-charcoal-400 mb-2">SKU: {{ $accessory->sku }}</p>
                            @endif
                            @if ($accessory->short_description)
                                <p class="text-sm text-charcoal-500 leading-relaxed line-clamp-2 mb-3">
                                    {{ $accessory->short_description }}
                                </p>
                            @endif
                            @if ($accessory->price)
                                <p class="text-sm font-semibold text-midnight-500">${{ number_format($accessory->price, 2) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Bottom CTAs --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 text-center">
        <h2 class="text-2xl font-display font-bold text-midnight-500 mb-4">Ready to Get Started?</h2>
        <p class="text-charcoal-400 max-w-xl mx-auto mb-8">
            Configure your {{ $product->name }} with the right accessories, compare it with other models, or book a hands-on trial.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="/configurator?product={{ $product->id }}"
               class="btn-pill-primary inline-flex items-center gap-2 px-6 py-3 rounded-button text-sm font-semibold
                      bg-midnight-500 text-white hover:bg-midnight-400 transition-all duration-200">
                Configure This Product
            </a>
            <a href="/compare?product={{ $product->id }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-button text-sm font-semibold
                      border-2 border-steel-300 text-charcoal-500 hover:border-midnight-300 hover:text-midnight-500 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Compare Products
            </a>
            <a href="/book-trial"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-button text-sm font-semibold
                      border-2 border-midnight-500 text-midnight-500 hover:bg-midnight-500 hover:text-white transition-all duration-200">
                Book a Trial
            </a>
        </div>
    </section>

</div>
