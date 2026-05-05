@php
    $items = $section->content['items'] ?? [];
    $iconMap = [
        'lightning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        'leaf' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'globe' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>',
        'chip' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>',
        'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
    ];
@endphp

@if (!empty($items))
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($section->title)
                <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4">{{ $section->title }}</h2>
            @endif
            @if ($section->subtitle)
                <p class="text-gray-500 text-center mb-12 max-w-2xl mx-auto">{{ $section->subtitle }}</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($items as $item)
                    <div class="text-center p-6">
                        @if (!empty($item['icon']))
                            <div class="w-14 h-14 mx-auto mb-4 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $iconMap[$item['icon']] ?? $iconMap['lightning'] !!}
                                </svg>
                            </div>
                        @endif
                        <h3 class="text-lg font-semibold mb-2">{{ $item['title'] ?? '' }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $item['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
