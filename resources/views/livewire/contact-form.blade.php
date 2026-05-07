<div class="max-w-3xl mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-slate-800">Contact Us</h1>
        <p class="mt-3 text-slate-500">Select a category below to help us direct your inquiry to the right team.</p>
    </div>

    @if ($submitted)
        <div class="bg-green-50 border border-green-200 rounded-xl p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-green-800">Thank You!</h2>
            <p class="mt-2 text-green-700">Your inquiry has been submitted successfully. Our team will get back to you shortly.</p>
            <button
                wire:click="$set('submitted', false)"
                class="mt-6 inline-flex items-center px-5 py-2.5 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition"
            >
                Submit Another Inquiry
            </button>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            {{-- Tab Navigation --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 border-b border-slate-200">
                @foreach (['Sales Support', 'Service Support', 'Cooking Support', 'General Inquiry'] as $tab)
                    <button
                        wire:click="selectCategory('{{ $tab }}')"
                        @class([
                            'px-4 py-3 text-sm font-medium transition border-b-2',
                            'border-orange-500 text-orange-600 bg-orange-50/50' => $category === $tab,
                            'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50' => $category !== $tab,
                        ])
                    >
                        {{ $tab }}
                    </button>
                @endforeach
            </div>

            {{-- Form --}}
            <form wire:submit="submit" class="p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Name <span class="text-red-500">*</span></label>
                        <input
                            type="text" id="name" wire:model="name"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition"
                            placeholder="Your full name"
                        >
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                        <input
                            type="email" id="email" wire:model="email"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition"
                            placeholder="you@company.com"
                        >
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone</label>
                        <input
                            type="tel" id="phone" wire:model="phone"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition"
                            placeholder="+62 812 3456 7890"
                        >
                        @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-700 mb-1.5">Company</label>
                        <input
                            type="text" id="company" wire:model="company"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition"
                            placeholder="Your company name"
                        >
                        @error('company') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="country" class="block text-sm font-medium text-slate-700 mb-1.5">Country</label>
                        <input
                            type="text" id="country" wire:model="country"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition"
                            placeholder="Indonesia"
                        >
                        @error('country') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <p class="block text-sm font-medium text-slate-700 mb-1.5">Category <span class="text-red-500">*</span></p>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-slate-600">
                                @if ($category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                        {{ $category }}
                                    </span>
                                @else
                                    <span class="text-slate-400">Select a category from the tabs above</span>
                                @endif
                            </span>
                        </div>
                        @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-1.5">Message <span class="text-red-500">*</span></label>
                        <textarea
                            id="message" wire:model="message" rows="5"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition resize-y"
                            placeholder="Tell us about your needs and how we can help..."
                        ></textarea>
                        @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- reCAPTCHA-like visual element --}}
                <div class="mt-6 flex items-start gap-3 p-4 bg-slate-50 rounded-lg border border-slate-200">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="w-5 h-5 rounded border-2 border-slate-300 bg-white flex items-center justify-center">
                            <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Protected by reCAPTCHA</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            <a href="#" class="hover:text-slate-600 underline">Privacy</a> &middot;
                            <a href="#" class="hover:text-slate-600 underline">Terms</a>
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-slate-800 text-white text-sm font-medium rounded-lg hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition"
                    >
                        <svg wire:loading wire:target="submit" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="submit">Send Inquiry</span>
                        <span wire:loading wire:target="submit">Sending...</span>
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
