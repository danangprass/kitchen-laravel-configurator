<section class="py-16 sm:py-20 bg-gray-900 text-white">
    <div class="max-w-2xl mx-auto px-4 text-center">
        @if ($section->title)
            <h2 class="text-3xl font-bold mb-3">{{ $section->title }}</h2>
        @endif
        @if ($section->subtitle)
            <p class="text-gray-400 mb-8">{{ $section->subtitle }}</p>
        @endif

        <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
            <input type="email" placeholder="Your email address" required
                   class="flex-1 px-4 py-3 rounded-md bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-white/40">
            <button type="submit"
                    class="px-6 py-3 bg-white text-gray-900 rounded-md font-medium hover:bg-gray-100 transition-colors">
                {{ $section->cta_text ?: 'Subscribe' }}
            </button>
        </form>
    </div>
</section>
