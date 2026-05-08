<section class="py-12 lg:py-16 bg-ice-500">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($section->title)
            <h2 class="font-display font-bold text-2xl text-midnight-500 mb-6">{{ $section->title }}</h2>
        @endif
        @if (!empty($section->content['body']))
            <div class="prose prose-charcoal max-w-none text-charcoal-500 leading-relaxed text-sm">
                {!! strip_tags($section->content['body'], '<p><a><strong><em><ul><ol><li><h3><h4><br><span>') !!}
            </div>
        @endif
    </div>
</section>
