{{--
  Bakomatic-Inspired Landing Page
  Premium industrial feel — dark + white, generous rounding, data-driven sections
--}}
@section('title', config('app.name', 'Kitchen') . ' — Commercial Kitchen Solutions')

<x-layouts.home>

    {{-- ═══════════════════════════════════════════
    HERO SECTION
    Dark overlay with white accent, large display heading, premium industrial vibe
    ═══════════════════════════════════════════ --}}
    <section class="relative bg-midnight-500 min-h-[85vh] flex items-center overflow-hidden">
        {{-- Subtle radial glow behind hero --}}
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                        w-[800px] h-[800px] rounded-full bg-white/5 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="max-w-3xl">
                {{-- Eyebrow — uppercase white label --}}
                <span class="inline-block text-white font-semibold text-xs tracking-widest uppercase mb-6">
                    Professional Kitchen Solutions
                </span>

                {{-- Main heading — large Funnel Display --}}
                <h1 class="font-display font-extrabold text-5xl sm:text-6xl lg:text-7xl text-white leading-[1.1] mb-6">
                    Mastering Every<br class="hidden sm:block"> Bake
                </h1>

                {{-- Subtitle — charcoal body text on dark --}}
                <p class="text-lg sm:text-xl text-white/60 max-w-xl mb-10 leading-relaxed">
                    Commercial kitchen equipment that blends artisan tradition with smart technology,
                    delivering consistent results every single time.
                </p>

                {{-- CTA Buttons — pill shaped, matching Bakomatic --}}
                <div class="flex flex-wrap gap-4">
                    <a href="/configurator"
                       class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                              bg-white text-midnight-500 hover:bg-gray-200
                              transition-all duration-300 shadow-lg shadow-white/25
                              hover:shadow-xl hover:shadow-white/30 hover:-translate-y-0.5">
                        Build Your Configuration
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="/calculator"
                       class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                              border-2 border-white/20 text-white hover:border-white hover:text-white
                              transition-all duration-300">
                        Calculate ROI
                    </a>
                </div>

                {{-- Trust indicators — subtle social proof --}}
                <div class="mt-16 flex flex-wrap items-center gap-8 text-sm text-white/40">
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-midnight-500/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                            </svg>
                        </span>
                        ISO 9001 Certified
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-midnight-500/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                            </svg>
                        </span>
                        10+ Years of Engineering
                    </span>
                    <span class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-midnight-500/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                            </svg>
                        </span>
                        24/7 Technical Support
                    </span>
                </div>
            </div>
        </div>

        {{-- Bottom fade transition to next section --}}
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-b from-transparent to-warm-white-500 pointer-events-none"
             aria-hidden="true"></div>
    </section>

    {{-- ═══════════════════════════════════════════
    ABOUT / INTRODUCTION
    "Global Expertise in Every Detail" — clean two-column
    ═══════════════════════════════════════════ --}}
    <section class="py-16 lg:py-24 bg-warm-white-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Left: headline + description --}}
                <div>
                    <h2 class="font-display font-bold text-4xl lg:text-5xl text-midnight-500 leading-[1.15] mb-6">
                        Global Expertise<br> in Every Detail
                    </h2>
                    <p class="text-charcoal-500 text-lg leading-relaxed mb-6">
                        We are part of a larger manufacturing ecosystem with decades of experience
                        in commercial kitchen equipment. Every oven and machine we build is engineered
                        as a long-term investment for your business.
                    </p>
                    <p class="text-charcoal-400 leading-relaxed mb-8">
                        From precision temperature control to energy-efficient heat circulation,
                        our equipment is designed for the demanding workflows of professional
                        bakeries and pastry kitchens.
                    </p>
                    <a href="/about"
                       class="inline-flex items-center gap-2 text-midnight-500 hover:text-charcoal-600 font-semibold text-sm
                              transition-colors duration-200 group">
                        Learn more about us
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Right: stat card grid --}}
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white rounded-card p-6 border border-steel-500/50 shadow-sm">
                        <div class="text-3xl font-display font-bold text-midnight-500 mb-1">25+</div>
                        <div class="text-sm text-charcoal-400">Years Engineering<br> Experience</div>
                    </div>
                    <div class="bg-white rounded-card p-6 border border-steel-500/50 shadow-sm">
                        <div class="text-3xl font-display font-bold text-midnight-500 mb-1">500+</div>
                        <div class="text-sm text-charcoal-400">Installations<br> Worldwide</div>
                    </div>
                    <div class="bg-white rounded-card p-6 border border-steel-500/50 shadow-sm">
                        <div class="text-3xl font-display font-bold text-midnight-500 mb-1">98%</div>
                        <div class="text-sm text-charcoal-400">Client Retention<br> Rate</div>
                    </div>
                    <div class="bg-white rounded-card p-6 border border-steel-500/50 shadow-sm">
                        <div class="text-3xl font-display font-bold text-midnight-500 mb-1">24/7</div>
                        <div class="text-sm text-charcoal-400">Technical<br> Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
    PRODUCT PILLARS
    Three cards — Smart Deck Ovens, Rotary Ovens, Proofing Systems
    ═══════════════════════════════════════════ --}}
    <section class="py-16 lg:py-24 bg-ice-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section header --}}
            <div class="text-center max-w-2xl mx-auto mb-14 lg:mb-20">
                <span class="text-midnight-500 font-semibold text-xs tracking-widest uppercase">
                    Core Equipment
                </span>
                <h2 class="font-display font-bold text-4xl lg:text-5xl text-midnight-500 mt-4 mb-6">
                    Pillars of Your<br> Professional Kitchen
                </h2>
                <p class="text-charcoal-400 text-lg leading-relaxed">
                    Every piece of equipment is purpose-built for the demanding
                    standards of modern bakery and pastry operations.
                </p>
            </div>

            {{-- Three pillar cards — 30px rounding, matching Bakomatic --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Pillar 1: Smart Deck Ovens --}}
                <div class="bg-white rounded-card border border-steel-500/30 p-8
                            transition-all duration-300 hover:-translate-y-1
                            hover:shadow-xl hover:shadow-midnight-500/5 group cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-midnight-500/10 flex items-center justify-center mb-6
                                group-hover:bg-midnight-500/20 transition-colors duration-300">
                        <svg class="w-7 h-7 text-midnight-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-xl text-midnight-500 mb-3">Smart Deck Ovens</h3>
                    <p class="text-charcoal-400 text-sm leading-relaxed mb-5">
                        Precision temperature at every level for perfect bread texture.
                        Digital PID controls eliminate guesswork.
                    </p>
                    <a href="/products/deck-ovens"
                       class="inline-flex items-center gap-1.5 text-midnight-500 hover:text-charcoal-600 font-semibold text-sm
                              transition-colors duration-200">
                        Explore Series
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Pillar 2: Rotary Ovens --}}
                <div class="bg-white rounded-card border border-steel-500/30 p-8
                            transition-all duration-300 hover:-translate-y-1
                            hover:shadow-xl hover:shadow-midnight-500/5 group cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-midnight-500/10 flex items-center justify-center mb-6
                                group-hover:bg-midnight-500/20 transition-colors duration-300">
                        <svg class="w-7 h-7 text-midnight-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-xl text-midnight-500 mb-3">Rotary Ovens</h3>
                    <p class="text-charcoal-400 text-sm leading-relaxed mb-5">
                        High-capacity production with even heat circulation and
                        superior energy efficiency for large-scale bakeries.
                    </p>
                    <a href="/products/rotary-ovens"
                       class="inline-flex items-center gap-1.5 text-midnight-500 hover:text-charcoal-600 font-semibold text-sm
                              transition-colors duration-200">
                        Explore Series
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Pillar 3: Proofing Systems --}}
                <div class="bg-white rounded-card border border-steel-500/30 p-8
                            transition-all duration-300 hover:-translate-y-1
                            hover:shadow-xl hover:shadow-midnight-500/5 group cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-midnight-500/10 flex items-center justify-center mb-6
                                group-hover:bg-midnight-500/20 transition-colors duration-300">
                        <svg class="w-7 h-7 text-midnight-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-xl text-midnight-500 mb-3">Proofing Systems</h3>
                    <p class="text-charcoal-400 text-sm leading-relaxed mb-5">
                        Precise humidity and temperature control to maximize
                        dough development for consistent crumb structure.
                    </p>
                    <a href="/products/proofing"
                       class="inline-flex items-center gap-1.5 text-midnight-500 hover:text-charcoal-600 font-semibold text-sm
                              transition-colors duration-200">
                        Explore Series
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
    PERFORMANCE STATS
    Data-driven credibility — capacity, accuracy, productivity
    ═══════════════════════════════════════════ --}}
    <section class="py-16 lg:py-24 bg-midnight-500 relative overflow-hidden">
        {{-- Background accent --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"
             aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 lg:mb-20">
                <span class="text-white font-semibold text-xs tracking-widest uppercase">
                    Engineered Performance
                </span>
                <h2 class="font-display font-bold text-4xl lg:text-5xl text-white mt-4">
                    Designed for Efficiency<br> at Every Bake
                </h2>
            </div>

            {{-- Stats grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Stat 1 --}}
                <div class="text-center">
                    <div class="text-5xl lg:text-6xl font-display font-extrabold text-white mb-2">
                        92<span class="text-3xl">×</span>80
                    </div>
                    <div class="text-white/50 text-sm leading-relaxed max-w-[200px] mx-auto">
                        cm baking chamber — fits 6 trays per deck with zero dead space
                    </div>
                </div>

                {{-- Stat 2 --}}
                <div class="text-center">
                    <div class="text-5xl lg:text-6xl font-display font-extrabold text-white mb-2">
                        ±1<small class="text-2xl">°C</small>
                    </div>
                    <div class="text-white/50 text-sm leading-relaxed max-w-[200px] mx-auto">
                        digital temperature deviation vs. ±15°C in manual gas ovens
                    </div>
                </div>

                {{-- Stat 3 --}}
                <div class="text-center">
                    <div class="text-5xl lg:text-6xl font-display font-extrabold text-white mb-2">
                        96
                    </div>
                    <div class="text-white/50 text-sm leading-relaxed max-w-[200px] mx-auto">
                        croissants or 72 danish pastries in a single production cycle
                    </div>
                </div>

                {{-- Stat 4 --}}
                <div class="text-center">
                    <div class="text-5xl lg:text-6xl font-display font-extrabold text-white mb-2">
                        30<small class="text-2xl">%</small>
                    </div>
                    <div class="text-white/50 text-sm leading-relaxed max-w-[200px] mx-auto">
                        less energy consumption with dual-layer glass door heat retention
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
    CTA BANNER
    "Build Your Configuration" — dark card with white CTA
    ═══════════════════════════════════════════ --}}
    <section class="py-16 lg:py-24 bg-warm-white-500">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-midnight-500 rounded-card p-10 lg:p-16 text-center relative overflow-hidden">
                {{-- Decorative glow --}}
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-96 h-48
                            bg-midnight-500/10 rounded-full blur-3xl pointer-events-none"
                     aria-hidden="true"></div>

                <h2 class="relative font-display font-bold text-3xl lg:text-4xl text-white mb-4">
                    Ready to Build Your Kitchen?
                </h2>
                <p class="relative text-white/60 text-lg mb-8 max-w-lg mx-auto leading-relaxed">
                    Use our interactive configurator to design the perfect layout,
                    compare equipment, and get an instant estimate &mdash; all in one place.
                </p>
                <div class="relative flex flex-wrap justify-center gap-4">
                    <a href="/configurator"
                       class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                              bg-white text-midnight-500 hover:bg-gray-200
                              transition-all duration-300 shadow-lg shadow-white/25">
                        Launch Configurator
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="/products"
                       class="inline-flex items-center px-8 py-3.5 rounded-button text-sm font-semibold
                              border-2 border-white/20 text-white hover:border-white hover:text-white
                              transition-all duration-300">
                        Browse All Products
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
    NEWSLETTER SIGNUP
    "Achieve consistency in every bake" — matching Bakomatic's block
    ═══════════════════════════════════════════ --}}
    <section class="py-16 lg:py-24 bg-ice-500">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-midnight-500 font-semibold text-xs tracking-widest uppercase">
                Stay Updated
            </span>
            <h2 class="font-display font-bold text-3xl lg:text-4xl text-midnight-500 mt-4 mb-4">
                Achieve Consistency<br> in Every Bake
            </h2>
            <p class="text-charcoal-400 mb-8 leading-relaxed">
                Get technical guides, kitchen optimization tips, and the latest
                equipment updates delivered straight to your inbox.
            </p>

            {{-- Newsletter form --}}
            <form action="/subscribe" method="POST"
                  class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                @csrf
                <input type="email" name="email" placeholder="Enter your email address" required
                       class="flex-1 h-[55px] px-6 rounded-form border-2 border-steel-500
                              bg-white text-charcoal-500 placeholder:text-charcoal-300
                              focus:border-charcoal-500 focus:outline-none focus:ring-2 focus:ring-charcoal-500/20
                              transition-colors duration-200 text-sm" />
                <button type="submit"
                        class="h-[55px] px-8 rounded-button bg-midnight-500 text-white
                               font-semibold text-sm hover:bg-charcoal-600
                               transition-all duration-300 shadow-sm shadow-midnight-500/25
                               hover:shadow-md hover:-translate-y-0.5 whitespace-nowrap">
                    Subscribe
                </button>
            </form>
            <p class="text-xs text-charcoal-300 mt-4">
                No spam. Unsubscribe anytime. Read our
                <a href="{{ route('privacy-policy') }}" class="text-midnight-500 hover:text-charcoal-600 underline">Privacy Policy</a>.
            </p>
        </div>
    </section>

</x-layouts.home>
