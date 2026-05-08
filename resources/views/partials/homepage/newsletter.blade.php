@php
    $eyebrow = $section->content['eyebrow'] ?? null;
@endphp

<section class="py-16 lg:py-24 bg-midnight-500 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"
         aria-hidden="true"></div>

    <div class="relative max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if ($eyebrow)
            <span class="inline-block text-white font-semibold text-xs tracking-widest uppercase mb-4">
                {{ $eyebrow }}
            </span>
        @endif
        @if ($section->title)
            <h2 class="font-display font-bold text-4xl lg:text-5xl text-white mb-4">{{ $section->title }}</h2>
        @endif
        @if ($section->subtitle)
            <p class="text-white/60 text-lg mb-10 leading-relaxed">{{ $section->subtitle }}</p>
        @endif

        @if (session()->has('newsletter_subscribed'))
            <div class="bg-white/10 border border-white/30 rounded-card px-6 py-4 text-white text-sm font-medium"
                 x-data="{ show: true }" x-show="show" x-transition>
                Thanks! We'll be in touch.
            </div>
        @else
            <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                <input type="email" wire:model="email" placeholder="Enter your email address" required
                       class="flex-1 h-[55px] px-6 rounded-form border-2 border-white/20
                              bg-white/5 text-white placeholder:text-white/40
                              focus:border-white focus:outline-none focus:ring-2 focus:ring-white/20
                              transition-colors duration-200 text-sm" />
                <button type="submit"
                        class="h-[55px] px-8 rounded-button bg-white text-midnight-500
                               font-semibold text-sm hover:bg-gray-200
                               transition-all duration-300 shadow-lg shadow-white/25
                               hover:shadow-xl hover:shadow-white/30 hover:-translate-y-0.5 whitespace-nowrap">
                    {{ $section->cta_text ?: 'Subscribe' }}
                </button>
            </form>
        @endif

        @if (!session()->has('newsletter_subscribed'))
            <p class="text-xs text-white/30 mt-5">
                No spam. Unsubscribe anytime. Read our
                <a href="{{ route('privacy-policy') }}" class="text-white hover:text-gray-300 underline transition-colors">Privacy Policy</a>.
            </p>
        @endif
    </div>
</section>
