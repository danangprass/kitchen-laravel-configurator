@php
    $style = $section->content['style'] ?? 'dark';
    $eyebrow = $section->content['eyebrow'] ?? null;
@endphp

<section class="py-16 lg:py-24 {{ $style === 'light' ? 'bg-ice-500' : 'bg-midnight-500' }} relative overflow-hidden">
    @if ($style !== 'light')
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"
             aria-hidden="true"></div>
    @endif

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if ($eyebrow)
            <span class="inline-block {{ $style === 'light' ? 'text-midnight-500' : 'text-white' }} font-semibold text-xs tracking-widest uppercase mb-4">
                {{ $eyebrow }}
            </span>
        @endif
        @if ($section->title)
            <h2 class="font-display font-bold text-4xl lg:text-5xl {{ $style === 'light' ? 'text-midnight-500' : 'text-white' }} mb-5">
                {{ $section->title }}
            </h2>
        @endif
        @if ($section->subtitle)
            <p class="text-lg {{ $style === 'light' ? 'text-charcoal-400' : 'text-white/60' }} mb-10 max-w-2xl mx-auto leading-relaxed">
                {{ $section->subtitle }}
            </p>
        @endif
        @if ($section->cta_text && $section->cta_url)
            <a href="{{ url($section->cta_url) }}"
               class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                      transition-all duration-300
                      {{ $style === 'light' ?
                          'bg-midnight-500 text-white hover:bg-charcoal-600 shadow-sm hover:shadow-md' :
                          'bg-white text-midnight-500 hover:bg-gray-200 shadow-lg shadow-white/25 hover:shadow-xl hover:shadow-white/30' }}
                      hover:-translate-y-0.5">
                {{ $section->cta_text }}
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        @endif
    </div>
</section>
