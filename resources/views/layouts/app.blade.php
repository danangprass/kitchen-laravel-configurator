<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <title>@yield('title', config('app.name', 'Kitchen Configurator'))</title>

    {{-- Fonts: Funnel Display (headings) + Instrument Sans (body) — matching Bakomatic --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=funnel-display:400,500,600,700,800|instrument-sans:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Instrument Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                            display: ['"Funnel Display"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        },
                        colors: {
                            gold: {
                                50: '#ffffff',
                                100: '#f9fafb',
                                200: '#f3f4f6',
                                300: '#e5e7eb',
                                400: '#d1d5db',
                                500: '#ffffff',
                                600: '#f3f4f6',
                                700: '#e5e7eb',
                                800: '#d1d5db',
                                900: '#9ca3af',
                                950: '#6b7280',
                            },
                            midnight: {
                                50: '#e6e7e8',
                                100: '#b1b3b6',
                                200: '#8b8e92',
                                300: '#565b60',
                                400: '#353b41',
                                500: '#080C0E',
                                600: '#070b0d',
                                700: '#06080a',
                                800: '#040608',
                                900: '#030506',
                            },
                            charcoal: {
                                50: '#eeefef',
                                100: '#c9cccc',
                                200: '#afb3b4',
                                300: '#8a8f91',
                                400: '#73797b',
                                500: '#515455',
                                600: '#4a4c4d',
                                700: '#3a3c3c',
                                800: '#2d2e2f',
                                900: '#222324',
                            },
                            steel: {
                                50: '#f4f6f7',
                                100: '#f0f3f5',
                                200: '#ecf0f3',
                                300: '#dce5ea',
                                400: '#c5d1d9',
                                500: '#E1E8ED',
                                600: '#a3b5c1',
                                700: '#7f93a0',
                                800: '#627382',
                                900: '#4b5a68',
                            },
                            ice: {
                                50: '#f8f9fa',
                                100: '#f5f7f8',
                                200: '#f3f5f7',
                                300: '#eef2f4',
                                400: '#e8edf0',
                                500: '#F2F5F7',
                                600: '#c4cdd3',
                                700: '#96a3ab',
                                800: '#6e7c84',
                                900: '#546068',
                            },
                            'warm-white': {
                                50: '#ffffff',
                                100: '#fefefe',
                                200: '#fefefe',
                                300: '#fdfcfb',
                                400: '#fcfbf9',
                                500: '#FAFBFC',
                                600: '#c8c9ca',
                                700: '#969797',
                                800: '#646565',
                                900: '#323333',
                            },
                        },
                        borderRadius: {
                            'card': '1.875rem',
                            'form': '1.875rem',
                            'pill': '6.25rem',
                            'button': '6.25rem',
                        },
                        fontSize: {
                            'body': ['1.0625rem', { lineHeight: '1.65' }],
                        },
                    }
                }
            }
        </script>
        <style>
            :root {
                --color-accent: #ffffff;
                --color-accent-hover: #e5e7eb;
                --color-accent-link: #ffffff;
                --color-surface-dark: #080C0E;
                --color-text-body: #515455;
                --color-text-heading: #080C0E;
            }

            html {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            body {
                background-color: #FAFBFC;
                color: #515455;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Funnel Display', ui-sans-serif, system-ui, sans-serif;
                font-weight: 700;
                color: #080C0E;
                line-height: 1.5;
            }

            h1 { font-size: 2.5rem; }
            h2 { font-size: 2.1875rem; }
            h3 { font-size: 1.875rem; }
            h4 { font-size: 1.5625rem; }
            h5 { font-size: 1.25rem; }
            h6 { font-size: 1rem; }

            a {
                color: #E0A903;
                transition: color 0.2s ease;
            }

            a:hover {
                color: #FFBF00;
            }

            ::selection {
                background-color: #676767;
                color: #ffffff;
            }
        </style>
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
