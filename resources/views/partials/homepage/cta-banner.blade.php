@php
    $bgClass = 'bg-gray-900 text-white';
    $btnClass = 'bg-white text-gray-900 hover:bg-gray-100';
    if (($section->content['style'] ?? '') === 'light') {
        $bgClass = 'bg-gray-100 text-gray-900';
        $btnClass = 'bg-gray-900 text-white hover:bg-gray-800';
    } elseif (($section->content['style'] ?? '') === 'gradient') {
        $bgClass = 'bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white';
        $btnClass = 'bg-white text-gray-900 hover:bg-gray-100';
    }
@endphp

<section class="py-16 sm:py-20 {{ $bgClass }}">
    <div class="max-w-4xl mx-auto px-4 text-center">
        @if ($section->title)
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">{{ $section->title }}</h2>
        @endif
        @if ($section->subtitle)
            <p class="text-lg opacity-80 mb-8 max-w-2xl mx-auto">{{ $section->subtitle }}</p>
        @endif
        @if ($section->cta_text && $section->cta_url)
            <a href="{{ url($section->cta_url) }}"
               class="inline-block {{ $btnClass }} px-8 py-4 rounded-md font-semibold text-lg transition-colors">
                {{ $section->cta_text }}
            </a>
        @endif
    </div>
</section>
