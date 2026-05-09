<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Book a Free Oven Trial</h1>
            <p class="mt-3 text-lg text-gray-600">
                Experience our ovens firsthand with a complimentary on-site demonstration tailored to your kitchen needs.
            </p>
        </div>

        @if ($submitted)
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                <div class="text-green-600 font-semibold text-lg mb-2">Thank you for your booking request!</div>
                <p class="text-green-700">We have received your details and will contact you shortly to confirm your trial date.</p>
            </div>
        @else
            <form wire:submit="submit" class="bg-white shadow-sm rounded-lg p-8 space-y-6">
                <p class="text-sm text-gray-500 mb-4">Fields marked <span class="text-red-500">*</span> are required.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="text" id="name" wire:model="name"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="Your full name">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="email" id="email" wire:model="email"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="you@example.com">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="tel" id="phone" wire:model="phone"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="+62 ...">
                        @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="text" id="company_name" wire:model="company_name"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="Your restaurant or business">
                        @error('company_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-500 ml-0.5">*</span></label>
                        <textarea id="address" wire:model="address" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="Your business address"></textarea>
                        @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="preferred_date_start" class="block text-sm font-medium text-gray-700 mb-1">Preferred Start Date <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="date" id="preferred_date_start" wire:model="preferred_date_start"
                            min="{{ date('Y-m-d') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                        @error('preferred_date_start') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="preferred_date_end" class="block text-sm font-medium text-gray-700 mb-1">Preferred End Date <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="date" id="preferred_date_end" wire:model="preferred_date_end"
                            min="{{ date('Y-m-d') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                        @error('preferred_date_end') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="oven_interest" class="block text-sm font-medium text-gray-700 mb-1">Oven Interest <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="text" id="oven_interest" wire:model="oven_interest"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="e.g. Bakertop Mind.Maps">
                        @error('oven_interest') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="meals_per_day" class="block text-sm font-medium text-gray-700 mb-1">Meals Per Day <span class="text-red-500 ml-0.5">*</span></label>
                        <input type="number" id="meals_per_day" wire:model="meals_per_day" min="1"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 placeholder-gray-400"
                            placeholder="e.g. 200">
                        @error('meals_per_day') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="text-center pt-4">
                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-medium rounded-md shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-50 disabled:cursor-not-allowed transition">
                        <span wire:loading.remove wire:target="submit">Submit Booking Request</span>
                        <span wire:loading wire:target="submit" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Submitting...
                        </span>
                    </button>
                </div>
            </form>
        @endif
    </div>
</section>
