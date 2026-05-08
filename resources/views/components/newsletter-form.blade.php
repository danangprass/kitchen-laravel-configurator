<div class="max-w-md mx-auto sm:mx-0">
    <h4 class="text-lg font-display font-bold mb-4 text-white">Newsletter</h4>
    <p class="text-white/60 text-sm mb-4 leading-relaxed">Stay updated with the latest products and offers.</p>

    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
        @csrf
        <input
            type="email"
            name="email"
            placeholder="Your email address"
            required
            class="w-full h-[48px] px-5 rounded-form border-2 border-white/20
                   bg-white/5 text-white placeholder:text-white/40
                   focus:border-white focus:outline-none focus:ring-2 focus:ring-white/20
                   transition-colors duration-200 text-sm"
        >

        <label class="flex items-start gap-2 text-xs text-white/40 cursor-pointer">
            <input type="checkbox" name="consent" required class="mt-0.5 accent-white">
            <span>
                I agree to receive marketing emails and accept the
                <a href="{{ route('privacy-policy') }}" class="text-white hover:text-gray-300 underline transition-colors">privacy policy</a>.
            </span>
        </label>

        <button
            type="submit"
            class="w-full h-[48px] rounded-button bg-white text-midnight-500
                   font-semibold text-sm hover:bg-gray-200
                   transition-all duration-300 shadow-sm shadow-white/25
                   hover:shadow-md hover:-translate-y-0.5"
        >
            Subscribe
        </button>

        <p class="text-white/30 text-xs mt-2 leading-relaxed">
            You can unsubscribe at any time via the link in our emails.
        </p>

        @if (session('newsletter_success'))
            <p class="text-green-400 text-sm mt-2">{{ session('newsletter_success') }}</p>
        @endif

        @if ($errors->has('email'))
            <p class="text-red-400 text-sm mt-2">{{ $errors->first('email') }}</p>
        @endif
    </form>
</div>
