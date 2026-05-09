@php
    $eyebrow = $section->content['eyebrow'] ?? $section->line_family;
@endphp

<section class="py-16 lg:py-24 bg-ice-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div>
                @if ($eyebrow)
                    <span class="inline-block text-midnight-500 font-semibold text-xs tracking-widest uppercase mb-4">
                        {{ $eyebrow }}
                    </span>
                @endif
                @if ($section->title)
                    <h2 class="font-display font-bold text-4xl lg:text-5xl text-midnight-500 leading-[1.15] mb-5">{{ $section->title }}</h2>
                @endif
                @if ($section->subtitle)
                    <p class="text-charcoal-400 text-lg leading-relaxed mb-8">{{ $section->subtitle }}</p>
                @endif
                @if ($section->cta_text && $section->cta_url)
                    <a href="{{ url($section->cta_url) }}"
                       class="inline-flex items-center gap-2 text-midnight-500 hover:text-charcoal-600 font-semibold text-sm
                              transition-colors duration-200 group">
                        {{ $section->cta_text }}
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endif
            </div>
            <div class="bg-white rounded-card border border-steel-500/50 overflow-hidden aspect-[4/3] shadow-sm">
                @if ($section->background_type === 'image' && $section->background_data)
                    <img src="{{ e($section->background_data) }}" alt="{{ $section->title }}"
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-ice-500 text-steel-400">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm">Product line image</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
