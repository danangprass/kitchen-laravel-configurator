<div class="max-w-md mx-auto sm:mx-0">
    <h4 class="text-lg font-display font-bold mb-4 text-white">Newsletter</h4>
    <p class="text-white/60 text-sm mb-4 leading-relaxed">Stay updated with the latest products and offers.</p>

    @if (session('newsletter_success'))
        <div class="flex items-start gap-3 p-4 rounded-xl bg-green-500/15 border border-green-500/30">
            <svg class="w-5 h-5 text-green-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="text-green-300 text-sm font-medium">You're subscribed!</p>
                <p class="text-green-400/70 text-xs mt-0.5">{{ session('newsletter_success') }}</p>
            </div>
        </div>
    @else
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Your email address"
                    value="{{ old('email') }}"
                    required
                    class="w-full h-[48px] px-5 rounded-form border-2 transition-colors duration-200 text-sm
                           {{ $errors->has('email') ? 'border-red-400/60 bg-red-500/5 text-white placeholder:text-white/40' : 'border-white/20 bg-white/5 text-white placeholder:text-white/40 focus:border-white focus:outline-none focus:ring-2 focus:ring-white/20' }}"
                >
                @if ($errors->has('email'))
                    <p class="flex items-center gap-1.5 text-red-400 text-xs mt-1.5">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>

            <label class="flex items-start gap-2 text-xs cursor-pointer
                          {{ $errors->has('consent') ? 'text-red-400/80' : 'text-white/40' }}">
                <input type="checkbox" name="consent" required
                       class="mt-0.5 accent-white"
                       {{ old('consent') ? 'checked' : '' }}>
                <span>
                    I agree to receive marketing emails and accept the
                    <a href="{{ route('privacy-policy') }}"
                       class="text-white hover:text-gray-300 underline transition-colors">privacy policy</a>.
                </span>
            </label>
            @if ($errors->has('consent'))
                <p class="flex items-center gap-1.5 text-red-400 text-xs -mt-1">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Please accept the privacy policy to subscribe.
                </p>
            @endif

            <button
                type="submit"
                class="w-full h-[48px] rounded-button bg-white text-midnight-500
                       font-semibold text-sm hover:bg-gray-200
                       transition-all duration-300 shadow-sm shadow-white/25
                       hover:shadow-md hover:-translate-y-0.5"
            >
                Subscribe
            </button>

            <p class="text-white/30 text-xs leading-relaxed">
                You can unsubscribe at any time via the link in our emails.
            </p>
        </form>
    @endif
</div>
