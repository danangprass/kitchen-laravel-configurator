<div class="bg-white">
    <!-- Header -->
    <section class="bg-gray-50 border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Frequently Asked Questions</h1>
            <p class="mt-4 text-lg text-gray-600">Find answers to common questions about our products and services.</p>
        </div>
    </section>

    <!-- Search -->
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input
                type="text"
                wire:model.live.debounce.300ms="searchQuery"
                placeholder="Search FAQs..."
                class="w-full pl-12 pr-4 py-4 text-gray-900 bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition"
            >
        </div>
    </section>

    <!-- Category Filters -->
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <button
                    wire:click="setCategory('{{ $category }}')"
                    @class([
                        'px-4 py-2 rounded-full text-sm font-medium transition-colors border',
                        'bg-gray-900 text-white border-gray-900' => $activeCategory === $category,
                        'bg-white text-gray-700 border-gray-200 hover:border-gray-400 hover:text-gray-900' => $activeCategory !== $category,
                    ])
                >
                    {{ $category }}
                </button>
            @endforeach
        </div>
    </section>

    <!-- FAQ List -->
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($faqs->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No results found</h3>
                <p class="mt-2 text-sm text-gray-500">Try adjusting your search or browse a different category.</p>
            </div>
        @else
            <div class="space-y-3" x-data>
                @foreach ($faqs as $faq)
                    <div class="border border-gray-200 rounded-xl overflow-hidden transition-shadow hover:shadow-sm"
                         x-data="{ open: @json(in_array($faq->id, $expandedFaqs)) }"
                         x-init="$watch('open', val => { if (val !== @json(in_array($faq->id, $expandedFaqs))) $wire.toggleFaq({{ $faq->id }}) })">
                        <button
                            @click="open = !open"
                            class="w-full flex items-center justify-between px-6 py-5 text-left bg-white hover:bg-gray-50 transition-colors"
                        >
                            <span class="text-base font-medium text-gray-900 pr-8">{{ $faq->question }}</span>
                            <span class="flex-shrink-0 text-gray-400 transition-transform duration-300"
                                  :class="{ 'rotate-180': open }">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="px-6 pb-5"
                        >
                            <div class="pt-1 border-t border-gray-100">
                                <div class="text-sm text-gray-600 leading-relaxed space-y-3 mt-4">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <!-- Contact Footer -->
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 text-center">
        <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Can't find what you're looking for?</h3>
            <p class="mt-2 text-sm text-gray-600">Our team is here to help. Reach out and we'll get back to you as soon as possible.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 mt-4 px-6 py-3 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                Contact Us
            </a>
        </div>
    </section>
</div>
