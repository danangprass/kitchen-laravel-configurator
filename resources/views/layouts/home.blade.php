<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Kitchen') }} — Commercial Ovens</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-white text-gray-900 antialiased">
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-xl font-semibold tracking-tight">Kitchen</a>
                <nav class="flex items-center gap-6 text-sm font-medium">
                    <a href="/calculator" class="hover:text-gray-600 transition-colors">
                        Calculator
                    </a>
                    <a href="/configurator" class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition-colors">
                        Build your own
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kitchen</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Commercial ovens to build your success.<br>
                        Professional kitchen solutions for every need.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/configurator" class="hover:text-white transition-colors">Configurator</a></li>
                        <li><a href="/calculator" class="hover:text-white transition-colors">Calculator</a></li>
                        <li><a href="/configurator" class="hover:text-white transition-colors">All Products</a></li>
                        <li><a href="/faq" class="hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>info@kitchen.com</li>
                        <li>+62 81908852999</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Kitchen. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
