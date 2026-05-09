<div class="bg-white">
    {{-- Hero Header --}}
    <section class="relative bg-gray-900 text-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-4">Testimonials</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                Hear from chefs, hoteliers, and restaurant owners who trust Bakomatic ovens to deliver
                exceptional results every day.
            </p>
        </div>
    </section>

    {{-- Industry Filter --}}
    @if ($industries->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-wrap items-center gap-3">
                <button wire:click="$set('selectedIndustry', '')"
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                    {{ $selectedIndustry === '' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All
                </button>
                @foreach ($industries as $industry)
                    <button wire:click="selectIndustry('{{ $industry }}')"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                        {{ $selectedIndustry === $industry ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $industry }}
                    </button>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Featured Testimonials --}}
    @if ($featuredTestimonials->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Featured Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($featuredTestimonials as $testimonial)
                    <div class="bg-white border-2 border-gray-900 rounded-2xl p-8 relative">
                        <div class="absolute -top-3 right-6 bg-gray-900 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            Featured
                        </div>
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $testimonial->photo ?? 'https://picsum.photos/seed/default/80/80' }}"
                                alt="{{ $testimonial->customer_name }}"
                                class="w-16 h-16 rounded-full object-cover border-2 border-gray-200"
                                onerror="this.src='https://picsum.photos/seed/fallback/80/80'">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                                @if ($testimonial->industry)
                                    <span class="inline-block mt-1 text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">
                                        {{ $testimonial->industry }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex mb-3">
                            @php $stars = max(1, min(5, (int) $testimonial->rating)); @endphp
                            @for ($i = 0; $i < $stars; $i++)
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 text-sm leading-relaxed line-clamp-4">
                            "{{ $testimonial->quote }}"
                        </blockquote>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- All Testimonials Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        @if ($featuredTestimonials->isNotEmpty())
            <h2 class="text-2xl font-bold text-gray-900 mb-8">More Stories</h2>
        @endif

        @if ($testimonials->isEmpty() && $featuredTestimonials->isEmpty())
            <div class="text-center py-20">
                <h3 class="text-xl font-semibold text-gray-600">No testimonials yet</h3>
                <p class="text-gray-400 mt-2">Be the first to share your experience!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg hover:border-gray-300 transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $testimonial->photo ?? 'https://picsum.photos/seed/default/80/80' }}"
                                alt="{{ $testimonial->customer_name }}"
                                class="w-14 h-14 rounded-full object-cover border border-gray-200"
                                onerror="this.src='https://picsum.photos/seed/fallback/80/80'">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                                @if ($testimonial->industry)
                                    <span class="inline-block mt-1 text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">
                                        {{ $testimonial->industry }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex mb-3">
                            @php $stars = max(1, min(5, (int) $testimonial->rating)); @endphp
                            @for ($i = 0; $i < $stars; $i++)
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 text-sm leading-relaxed line-clamp-4">
                            "{{ $testimonial->quote }}"
                        </blockquote>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Submit Testimonial CTA --}}
    <section class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @if ($submitted)
                <div class="bg-green-50 border border-green-200 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-green-800 mb-2">Thank You!</h3>
                    <p class="text-green-600">Your testimonial has been submitted and is pending review. We appreciate your feedback!</p>
                </div>
            @elseif ($submitForm)
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Share Your Experience</h2>
                <p class="text-gray-600 mb-8">We would love to hear how Bakomatic ovens have helped your business.</p>

                <form wire:submit="submitTestimonial" class="max-w-xl mx-auto space-y-5 text-left">
                    <div>
                        <label for="submitName" class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
                        <input type="text" id="submitName" wire:model="submitName"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900"
                            placeholder="Budi Santoso">
                        @error('submitName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="submitCompany" class="block text-sm font-medium text-gray-700 mb-1">Company / Restaurant</label>
                        <input type="text" id="submitCompany" wire:model="submitCompany"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900"
                            placeholder="Grand Hyatt Jakarta">
                        @error('submitCompany') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="submitQuote" class="block text-sm font-medium text-gray-700 mb-1">Your Testimonial *</label>
                        <textarea id="submitQuote" wire:model="submitQuote" rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900"
                            placeholder="Tell us about your experience with Bakomatic ovens..."></textarea>
                        @error('submitQuote') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating *</label>
                        <div class="flex gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('submitRating', {{ $i }})"
                                    class="text-2xl transition-transform {{ $i <= $submitRating ? 'scale-110' : 'opacity-30' }} hover:scale-125">
                                    <svg class="w-8 h-8 {{ $i <= $submitRating ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('submitRating') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                            Submit Testimonial
                        </button>
                        <button type="button" wire:click="toggleSubmitForm"
                            class="px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            @else
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Share Your Experience</h2>
                <p class="text-gray-600 mb-8">Join hundreds of satisfied customers. Tell us how Bakomatic ovens have transformed your bakomatic.</p>
                <button wire:click="toggleSubmitForm"
                    class="inline-flex items-center bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition-colors text-lg">
                    Share Your Story
                </button>
            @endif
        </div>
    </section>
</div>
