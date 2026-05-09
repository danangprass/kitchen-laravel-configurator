@component('layouts.home')
<div class="min-h-screen bg-warm-white-500">

    {{-- Hero --}}
    <section class="bg-midnight-500 text-white py-20 md:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="text-white/50 text-sm font-medium uppercase tracking-widest mb-4">Our Story</p>
                <h1 class="text-4xl md:text-5xl font-display font-bold leading-tight mb-6">
                    Engineering kitchens that<br class="hidden sm:block"> perform at every service.
                </h1>
                <p class="text-white/70 text-lg leading-relaxed">
                    We build commercial ovens and kitchen equipment that chefs rely on day after day —
                    engineered for consistency, designed for your workflow, and backed by a team that
                    understands professional kitchens from the inside out.
                </p>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-white border-b border-steel-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-4xl font-display font-bold text-midnight-500">15+</p>
                    <p class="text-sm text-charcoal-400 mt-1">Years in business</p>
                </div>
                <div>
                    <p class="text-4xl font-display font-bold text-midnight-500">5,000+</p>
                    <p class="text-sm text-charcoal-400 mt-1">Kitchens equipped</p>
                </div>
                <div>
                    <p class="text-4xl font-display font-bold text-midnight-500">30+</p>
                    <p class="text-sm text-charcoal-400 mt-1">Countries served</p>
                </div>
                <div>
                    <p class="text-4xl font-display font-bold text-midnight-500">98%</p>
                    <p class="text-sm text-charcoal-400 mt-1">Customer satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission & Values --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div>
                <h2 class="text-3xl font-display font-bold text-midnight-500 mb-4">Our Mission</h2>
                <p class="text-charcoal-500 leading-relaxed mb-4">
                    To help food businesses operate at their best by delivering kitchen equipment that
                    is reliable, energy-efficient, and easy to work with — from a single café to a
                    large-scale catering operation.
                </p>
                <p class="text-charcoal-500 leading-relaxed">
                    We believe professional kitchens deserve tools that keep up with demand, reduce
                    operating costs, and make the work of cooking more precise and consistent.
                </p>
            </div>

            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-xl bg-midnight-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-midnight-500 mb-1">Reliability first</h3>
                        <p class="text-sm text-charcoal-500 leading-relaxed">
                            Every product is tested under real kitchen conditions before it reaches your operation.
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-xl bg-midnight-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-midnight-500 mb-1">Energy efficiency</h3>
                        <p class="text-sm text-charcoal-500 leading-relaxed">
                            Our equipment is designed to reduce energy consumption without compromising output or cooking quality.
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-xl bg-midnight-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-midnight-500 mb-1">Partner support</h3>
                        <p class="text-sm text-charcoal-500 leading-relaxed">
                            From initial consultation to ongoing maintenance, our dealer network ensures you're never left alone.
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-xl bg-midnight-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-midnight-500 mb-1">Built to configure</h3>
                        <p class="text-sm text-charcoal-500 leading-relaxed">
                            No two kitchens are the same. Our modular lineup lets you assemble exactly the setup your operation requires.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-midnight-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-display font-bold mb-4">Ready to see it in action?</h2>
            <p class="text-white/60 mb-8 max-w-xl mx-auto">
                Book a no-obligation trial and experience the difference firsthand.
                Our team will walk you through the right configuration for your kitchen.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/book-trial"
                   class="inline-flex items-center justify-center px-8 py-3 rounded-button text-sm font-medium
                          bg-white text-midnight-500 hover:bg-white/90 hover:scale-[1.02]
                          transition-all duration-200 shadow-sm">
                    Book a Trial
                </a>
                <a href="/dealers"
                   class="inline-flex items-center justify-center px-8 py-3 rounded-button text-sm font-medium
                          bg-white/10 hover:bg-white/20 text-white border border-white/20
                          transition-all duration-200">
                    Find a Dealer
                </a>
            </div>
        </div>
    </section>

</div>
@endcomponent
