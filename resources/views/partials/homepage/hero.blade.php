@php
    $bgStyle = '';
    if ($section->background_type === 'color' && $section->background_data) {
        $bgStyle = 'background-color: ' . e($section->background_data) . ';';
    } elseif ($section->background_type === 'image' && $section->background_data) {
        $bgStyle = 'background-image: url(' . e($section->background_data) . '); background-size: cover; background-position: center;';
    }
@endphp

<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden" style="{{ $bgStyle }}">
    @if (!$bgStyle)
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
    @else
        <div class="absolute inset-0 bg-black/40"></div>
    @endif

    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
            {{ $section->title }}
        </h1>
        @if ($section->subtitle)
            <p class="text-lg sm:text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                {{ $section->subtitle }}
            </p>
        @endif
        @if ($section->cta_text && $section->cta_url)
            <a href="{{ url($section->cta_url) }}"
               class="inline-block bg-white text-gray-900 px-8 py-4 rounded-md font-semibold text-lg hover:bg-gray-100 transition-colors">
                {{ $section->cta_text }}
            </a>
        @endif
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>
