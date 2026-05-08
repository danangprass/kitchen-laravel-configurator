@php
    $bgColor = 'bg-midnight-500';
    $overlayClass = '';
    $bgStyle = '';

    if ($section->background_type === 'color' && $section->background_data) {
        $bgStyle = 'background-color: ' . e($section->background_data) . ';';
        $overlayClass = 'bg-black/20';
    } elseif ($section->background_type === 'image' && $section->background_data) {
        $bgStyle = 'background-image: url(' . e($section->background_data) . '); background-size: cover; background-position: center;';
        $overlayClass = 'bg-black/40';
    }

    $eyebrow = $section->content['eyebrow'] ?? null;
    $secondaryCtaText = $section->content['secondary_cta_text'] ?? null;
    $secondaryCtaUrl = $section->content['secondary_cta_url'] ?? null;
    $trustIndicators = $section->content['trust_indicators'] ?? [];
@endphp

<section class="relative min-h-[85vh] flex items-center overflow-hidden {{ !$bgStyle ? $bgColor : '' }}" style="{{ $bgStyle }}">
    @if (!$bgStyle)
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                        w-[800px] h-[800px] rounded-full bg-white/5 blur-3xl"></div>
        </div>
    @else
        <div class="absolute inset-0 {{ $overlayClass }}"></div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 w-full">
        <div class="max-w-3xl">
            @if ($eyebrow)
                <span class="inline-block text-white font-semibold text-xs tracking-widest uppercase mb-6">
                    {{ $eyebrow }}
                </span>
            @endif

            <h1 class="font-display font-extrabold text-5xl sm:text-6xl lg:text-7xl text-white leading-[1.1] mb-6">
                {{ $section->title }}
            </h1>

            @if ($section->subtitle)
                <p class="text-lg sm:text-xl text-white/60 max-w-xl mb-10 leading-relaxed">
                    {{ $section->subtitle }}
                </p>
            @endif

            @if ($section->cta_text && $section->cta_url)
                <div class="flex flex-wrap gap-4">
                    <a href="{{ url($section->cta_url) }}"
                       class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                              bg-white text-midnight-500 hover:bg-gray-200
                              transition-all duration-300 shadow-lg shadow-white/25
                              hover:shadow-xl hover:shadow-white/30 hover:-translate-y-0.5">
                        {{ $section->cta_text }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    @if ($secondaryCtaText && $secondaryCtaUrl)
                        <a href="{{ url($secondaryCtaUrl) }}"
                           class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                                  border-2 border-white/20 text-white hover:border-white hover:text-white
                                  transition-all duration-300">
                            {{ $secondaryCtaText }}
                        </a>
                    @endif
                </div>
            @endif

            @if (!empty($trustIndicators))
                <div class="mt-16 flex flex-wrap items-center gap-8 text-sm text-white/40">
                    @foreach ($trustIndicators as $indicator)
                        <span class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd" />
                                </svg>
                            </span>
                            {{ $indicator }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>

    @if (!$bgStyle)
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-b from-transparent to-warm-white-500 pointer-events-none"
             aria-hidden="true"></div>
    @endif
</section>
