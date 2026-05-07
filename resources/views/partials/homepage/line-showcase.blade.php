<section class="py-16 sm:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                @if ($section->line_family)
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">
                        {{ $section->line_family }}
                    </p>
                @endif
                @if ($section->title)
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4">{{ $section->title }}</h2>
                @endif
                @if ($section->subtitle)
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ $section->subtitle }}</p>
                @endif
                @if ($section->cta_text && $section->cta_url)
                    <a href="{{ url($section->cta_url) }}"
                       class="inline-block bg-gray-900 text-white px-6 py-3 rounded-md font-medium hover:bg-gray-800 transition-colors">
                        {{ $section->cta_text }}
                    </a>
                @endif
            </div>
            <div class="bg-gray-200 rounded-lg aspect-[4/3] flex items-center justify-center">
                @if ($section->background_type === 'image' && $section->background_data)
                    <img src="{{ e($section->background_data) }}" alt="{{ $section->title }}"
                         class="w-full h-full object-cover rounded-lg">
                @else
                    <div class="text-gray-400 text-center">
                        <svg class="w-20 h-20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm">{{ $section->line_family ? ucfirst($section->line_family) . ' lineup' : 'Product line image' }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
