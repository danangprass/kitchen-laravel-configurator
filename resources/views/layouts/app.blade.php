<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <title>@yield('title', config('app.name', 'Kitchen Configurator'))</title>

    {{-- Fonts: Funnel Display (headings) + Instrument Sans (body) — matching Bakomatic --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=funnel-display:400,500,600,700,800|instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')
</head>
<body class="antialiased">

    {{-- Sticky Header --}}
    <nav class="sticky top-0 z-50 bg-midnight-500/95 backdrop-blur border-b border-white/5"
         x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-[75px]">

                {{-- Brand --}}
                <div class="flex items-center gap-3">
                    <a href="/" class="flex items-center gap-2 shrink-0">
                        <span class="text-xl font-display font-bold text-white tracking-tight">
                            {{ config('app.name', 'Kitchen') }}
                        </span>
                    </a>
                </div>

                {{-- Desktop Navigation Links --}}
                <div class="hidden sm:flex items-center gap-5 text-sm font-medium">
                    <livewire:search-bar />

                    <a href="/products"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Products
                    </a>

                    <a href="/compare"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Compare
                    </a>

                    <a href="/configurator"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Configurator
                    </a>

                    <a href="/calculator"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Calculator
                    </a>

                    {{-- More dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @keydown.escape="open = false"
                                class="flex items-center gap-1 text-white/70 hover:text-white transition-colors duration-200">
                            More
                            <svg class="w-3.5 h-3.5 transition-transform duration-200"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-1"
                             class="absolute right-0 mt-2 w-48 bg-midnight-400 border border-white/10 rounded-xl shadow-xl py-2 z-50">
                            <a href="/dealers"
                               class="block px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                                Dealers
                            </a>
                            <a href="/testimonials"
                               class="block px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                                Testimonials
                            </a>
                            <a href="/about"
                               class="block px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                                About Us
                            </a>
                            <a href="/faq"
                               class="block px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                                FAQ
                            </a>
                            <a href="/contact"
                               class="block px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                                Contact
                            </a>
                            <a href="/book-trial"
                               class="block px-4 py-2 text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                                Book a Trial
                            </a>
                        </div>
                    </div>

                    {{-- Admin link with pill style --}}
                    <a href="/admin"
                       class="inline-flex items-center px-4 py-2 rounded-button text-sm font-medium
                              bg-white text-midnight-500 hover:bg-white/90 hover:scale-[1.02]
                              transition-all duration-200 shadow-sm shadow-white/25 hover:shadow-md hover:shadow-white/30">
                        Admin
                    </a>
                </div>

                {{-- Mobile menu trigger --}}
                <button class="sm:hidden text-white/70 hover:text-white transition-colors p-2"
                        @click="mobileOpen = !mobileOpen"
                        :aria-expanded="mobileOpen"
                        aria-label="Toggle menu">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="sm:hidden border-t border-white/10 bg-midnight-500">
            <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col gap-1">
                <a href="/products" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Products
                </a>
                <a href="/compare" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Compare
                </a>
                <a href="/configurator" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Configurator
                </a>
                <a href="/calculator" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Calculator
                </a>
                <a href="/dealers" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Dealers
                </a>
                <a href="/testimonials" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Testimonials
                </a>
                <a href="/about" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    About Us
                </a>
                <a href="/faq" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    FAQ
                </a>
                <a href="/contact" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Contact
                </a>
                <a href="/book-trial" @click="mobileOpen = false"
                   class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                    Book a Trial
                </a>
                <div class="border-t border-white/10 mt-2 pt-2">
                    <a href="/admin" @click="mobileOpen = false"
                       class="inline-flex items-center px-6 py-2.5 rounded-button text-sm font-medium
                              bg-white text-midnight-500 hover:bg-white/90 transition-all duration-200">
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    {{-- Footer — Dark with gold accents --}}
    <footer class="bg-midnight-500 text-white border-t border-white/5 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-white/40">
                {{ config('app.name', 'Kitchen') }} Configurator — Built with Laravel &amp; Livewire
            </p>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')

    <x-cookie-banner />

</body>
</html>
