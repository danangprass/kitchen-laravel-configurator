<div
    x-data="{ visible: false }"
    x-init="
        const consent = localStorage.getItem('cookie-consent');
        const timestamp = localStorage.getItem('cookie-consent-timestamp');
        const sixMonthsMs = 6 * 30 * 24 * 60 * 60 * 1000;

        if (!consent || !timestamp) {
            visible = true;
        } else if (Date.now() - parseInt(timestamp) > sixMonthsMs) {
            localStorage.removeItem('cookie-consent');
            localStorage.removeItem('cookie-consent-timestamp');
            visible = true;
        }
    "
    x-show="visible"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-8"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-8"
    class="fixed bottom-0 inset-x-0 z-50 p-4 sm:p-6"
    style="display: none;"
>
    <div class="mx-auto max-w-4xl bg-gray-900 text-white rounded-xl shadow-2xl p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <p class="text-sm text-gray-300 flex-1">
                We use cookies to improve your experience. By continuing, you agree to our
                <a href="{{ route('privacy-policy') }}" class="underline hover:text-white transition-colors">Privacy Policy</a>.
            </p>
            <div class="flex items-center gap-3 flex-shrink-0">
                <button
                    @@click="
                        localStorage.setItem('cookie-consent', 'declined');
                        localStorage.setItem('cookie-consent-timestamp', Date.now());
                        visible = false;
                    "
                    class="px-4 py-2 text-sm rounded-lg border border-gray-600 hover:border-gray-400 text-gray-300 hover:text-white transition-colors"
                >
                    Continue without accepting
                </button>
                <button
                    @@click="
                        localStorage.setItem('cookie-consent', 'accepted');
                        localStorage.setItem('cookie-consent-timestamp', Date.now());
                        visible = false;
                    "
                    class="px-4 py-2 text-sm rounded-lg bg-white text-gray-900 font-medium hover:bg-gray-100 transition-colors"
                >
                    Accept all
                </button>
            </div>
        </div>
    </div>
</div>
