<section class="py-12 sm:py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($section->title)
            <h2 class="text-2xl font-bold mb-6">{{ $section->title }}</h2>
        @endif
        @if (!empty($section->content['body']))
            <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed text-sm">
                {!! $section->content['body'] !!}
            </div>
        @endif
    </div>
</section>
