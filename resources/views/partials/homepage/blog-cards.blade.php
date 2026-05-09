@php
    $source = $section->content['source'] ?? 'manual';
    $articles = [];
    $eyebrow = $section->content['eyebrow'] ?? null;

    if ($source === 'manual') {
        $articles = $section->content['articles'] ?? [];
    }
@endphp

@if (!empty($articles))
    <section class="py-16 lg:py-24 bg-ice-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($eyebrow)
                <p class="text-midnight-500 font-semibold text-xs tracking-widest uppercase text-center mb-4">{{ $eyebrow }}</p>
            @endif
            @if ($section->title)
                <h2 class="font-display font-bold text-4xl lg:text-5xl text-midnight-500 text-center mb-4">{{ $section->title }}</h2>
            @endif
            @if ($section->subtitle)
                <p class="text-charcoal-400 text-center mb-14 max-w-2xl mx-auto text-lg leading-relaxed">{{ $section->subtitle }}</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ $article['url'] ?? '#' }}"
                       class="group bg-white rounded-card border border-steel-500/50 overflow-hidden
                              transition-all duration-300 hover:-translate-y-1
                              hover:shadow-xl hover:shadow-midnight-500/5">
                        @if (!empty($article['image']))
                            <div class="aspect-[16/10] overflow-hidden">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] ?? '' }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.onerror=null;this.src='/images/placeholder-product.svg'">
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="font-display font-bold text-lg text-midnight-500 mb-2 group-hover:text-charcoal-600 transition-colors line-clamp-2">
                                {{ $article['title'] ?? '' }}
                            </h3>
                            @if (!empty($article['excerpt']))
                                <p class="text-charcoal-400 text-sm leading-relaxed line-clamp-3">{{ $article['excerpt'] }}</p>
                            @endif
                            <span class="inline-flex items-center gap-1.5 text-midnight-500 font-semibold text-xs mt-4
                                         group-hover:text-charcoal-600 transition-colors">
                                Read more
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
