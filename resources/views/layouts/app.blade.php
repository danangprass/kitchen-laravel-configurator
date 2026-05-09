<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <title>@yield('title', config('app.name', 'Bakomatic Configurator'))</title>

    {{-- Fonts: Funnel Display (headings) + Instrument Sans (body) — matching Bakomatic --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=funnel-display:400,500,600,700,800|instrument-sans:400,500,600,700" rel="stylesheet" />

    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Funnel Display', 'sans-serif'],
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    colors: {
                        midnight: { 500: '#0f0f1a' },
                    },
                    borderRadius: {
                        form: '0.5rem',
                        button: '0.5rem',
                    },
                }
            }
        }
        </script>
    @endif

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
                            {{ config('app.name', 'Bakomatic') }}
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
                        </div>
                    </div>

                    <a href="/contact"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Contact
                    </a>
                    <a href="/book-trial"
                       class="inline-flex items-center px-6 py-2.5 rounded-button text-sm font-medium
                              bg-white text-midnight-500 hover:bg-white/90 hover:scale-[1.02]
                              transition-all duration-200 shadow-sm shadow-white/25 hover:shadow-md hover:shadow-white/30">
                        Book a Trial
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
                <div class="border-t border-white/10 mt-2 pt-2 flex flex-col gap-1">
                    <a href="/contact" @click="mobileOpen = false"
                       class="px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors duration-150">
                        Contact
                    </a>
                    <a href="/book-trial" @click="mobileOpen = false"
                       class="mt-1 inline-flex items-center justify-center px-6 py-2.5 rounded-button text-sm font-medium
                              bg-white text-midnight-500 hover:bg-white/90 transition-all duration-200">
                        Book a Trial
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-midnight-500 text-white py-16 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                {{-- Brand --}}
                <div>
                    <h4 class="text-lg font-display font-bold mb-4 text-white">{{ config('app.name', 'Bakomatic') }}</h4>
                    <p class="text-white/60 text-sm leading-relaxed mb-6">Commercial bakomatic solutions<br>engineered for consistency,<br>built for your success.</p>
                    <div class="flex items-center gap-3">
                        @if (config('contact.social.facebook'))
                            <a href="{{ config('contact.social.facebook') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                               class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 text-white/70 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if (config('contact.social.instagram'))
                            <a href="{{ config('contact.social.instagram') }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                               class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 text-white/70 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        @endif
                        @if (config('contact.social.youtube'))
                            <a href="{{ config('contact.social.youtube') }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"
                               class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 text-white/70 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-lg font-display font-bold mb-4 text-white">Explore</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li><a href="/products" class="hover:text-white transition-colors duration-200">All Products</a></li>
                        <li><a href="/compare" class="hover:text-white transition-colors duration-200">Compare Products</a></li>
                        <li><a href="/configurator" class="hover:text-white transition-colors duration-200">Configurator</a></li>
                        <li><a href="/calculator" class="hover:text-white transition-colors duration-200">Calculator</a></li>
                        <li><a href="/dealers" class="hover:text-white transition-colors duration-200">Find a Dealer</a></li>
                        <li><a href="/testimonials" class="hover:text-white transition-colors duration-200">Testimonials</a></li>
                        <li><a href="/about" class="hover:text-white transition-colors duration-200">About Us</a></li>
                        <li><a href="/faq" class="hover:text-white transition-colors duration-200">FAQ</a></li>
                        <li><a href="/contact" class="hover:text-white transition-colors duration-200">Contact</a></li>
                        <li><a href="/book-trial" class="hover:text-white transition-colors duration-200">Book a Trial</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <x-newsletter-form />

                {{-- Contact --}}
                <div>
                    <h4 class="text-lg font-display font-bold mb-4 text-white">Contact</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        @if (config('contact.email'))
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <a href="mailto:{{ config('contact.email') }}" class="hover:text-white transition-colors duration-200">{{ config('contact.email') }}</a>
                        </li>
                        @endif
                        @if (config('contact.phone'))
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', config('contact.phone')) }}" class="hover:text-white transition-colors duration-200">{{ config('contact.phone') }}</a>
                        </li>
                        @endif
                        @if (config('contact.address'))
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>{{ config('contact.address') }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-white/40">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Bakomatic') }}. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-white/70 transition-colors duration-200">Privacy Policy</a>
                    <a href="/terms" class="hover:text-white/70 transition-colors duration-200">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')


    <x-cookie-banner />

</body>
</html>
