<div class="max-w-md mx-auto sm:mx-0">
    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
    <p class="text-gray-400 text-sm mb-4">Stay updated with the latest products and offers.</p>

    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
        @csrf
        <input
            type="email"
            name="email"
            placeholder="Your email address"
            required
            class="w-full px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-white/50 text-sm"
        >

        <label class="flex items-start gap-2 text-xs text-gray-400 cursor-pointer">
            <input type="checkbox" name="consent" required class="mt-0.5 accent-white">
            <span>
                I agree to receive marketing emails and accept the
                <a href="{{ route('privacy-policy') }}" class="underline hover:text-white transition-colors">privacy policy</a>.
            </span>
        </label>

        <button
            type="submit"
            class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-lg font-medium text-sm hover:bg-gray-100 transition-colors"
        >
            Subscribe
        </button>

        <p class="text-gray-500 text-xs mt-2">
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
