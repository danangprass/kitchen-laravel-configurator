<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">

    <title>@yield('title', config('app.name', 'Kitchen')) — Commercial Kitchen Solutions</title>

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

    @stack('styles')
</head>
<body class="antialiased">

    {{-- Sticky Header — Dark background with gold accents, matching Bakomatic --}}
    <header class="sticky top-0 z-50 bg-midnight-500/95 backdrop-blur border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-[75px]">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2 shrink-0">
                    <span class="text-xl font-display font-bold text-white tracking-tight">
                        {{ config('app.name', 'Kitchen') }}
                    </span>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                    <livewire:search-bar />
                    <a href="/products"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Products
                    </a>
                    <a href="/configurator"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Configurator
                    </a>
                    <a href="/calculator"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Calculator
                    </a>
                    <a href="/contact"
                       class="text-white/70 hover:text-white transition-colors duration-200">
                        Contact
                    </a>
                    <a href="/configurator"
                       class="inline-flex items-center px-6 py-2.5 rounded-button text-sm font-medium
                              bg-white text-midnight-500 hover:bg-white/90 hover:scale-[1.02]
                              transition-all duration-200 shadow-sm shadow-white/25 hover:shadow-md hover:shadow-white/30">
                        Build your own
                    </a>
                </nav>

                {{-- Mobile menu trigger --}}
                <button class="lg:hidden text-white/70 hover:text-white transition-colors p-2"
                        aria-label="Open menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer — Dark with gold accents, matching Bakomatic --}}
    <footer class="bg-midnight-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">

                {{-- Brand --}}
                <div>
                    <h4 class="text-lg font-display font-bold mb-4 text-white">
                        {{ config('app.name', 'Kitchen') }}
                    </h4>
                    <p class="text-white/60 text-sm leading-relaxed">
                        Commercial kitchen solutions<br>
                        engineered for consistency,<br>
                        built for your success.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-lg font-display font-bold mb-4 text-white">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li><a href="/configurator" class="hover:text-white transition-colors duration-200">Configurator</a></li>
                        <li><a href="/calculator" class="hover:text-white transition-colors duration-200">Calculator</a></li>
                        <li><a href="/products" class="hover:text-white transition-colors duration-200">All Products</a></li>
                        <li><a href="/faq" class="hover:text-white transition-colors duration-200">FAQ</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="hover:text-white transition-colors duration-200">Privacy Policy</a></li>
                        <li><a href="/terms" class="hover:text-white transition-colors duration-200">Terms &amp; Conditions</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <x-newsletter-form />

                {{-- Contact --}}
                <div>
                    <h4 class="text-lg font-display font-bold mb-4 text-white">Contact</h4>
                    <ul class="space-y-2.5 text-sm text-white/60">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@kitchen.com</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 81908852999</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-white/40">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Kitchen') }}. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-white/70 transition-colors duration-200">Privacy Policy</a>
                    <a href="/terms" class="hover:text-white/70 transition-colors duration-200">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Cookie Consent Banner --}}
    <x-cookie-banner />

    @stack('scripts')
</body>
</html>
