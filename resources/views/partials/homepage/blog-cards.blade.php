@php
    $source = $section->content['source'] ?? 'manual';
    $articles = [];

    if ($source === 'manual') {
        $articles = $section->content['articles'] ?? [];
    }
    // Future: if source is 'posts_table', query from posts table
@endphp

@if (!empty($articles))
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($section->title)
                <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4">{{ $section->title }}</h2>
            @endif
            @if ($section->subtitle)
                <p class="text-gray-500 text-center mb-12 max-w-2xl mx-auto">{{ $section->subtitle }}</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ $article['url'] ?? '#' }}"
                       class="group bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
                        @if (!empty($article['image']))
                            <div class="aspect-[16/10] overflow-hidden">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] ?? '' }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-semibold mb-2 group-hover:text-gray-600 transition-colors line-clamp-2">
                                {{ $article['title'] ?? '' }}
                            </h3>
                            @if (!empty($article['excerpt']))
                                <p class="text-sm text-gray-500 line-clamp-3">{{ $article['excerpt'] }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
