<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kitchen Configurator')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        
                        'kitchen-dark': '#1a1a1a',
                    }
                }
            }
        }
    </script>
    @livewireStyles
</head>
<body class="bg-slate-50 min-h-screen">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-slate-700 tracking-tight">Kitchen</a>
                    <span class="ml-3 text-sm text-slate-500 hidden sm:inline">Configurator</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/calculator" class="text-sm text-slate-600 hover:text-slate-700 transition">Calculator</a>
                    <a href="/admin" class="text-sm text-slate-600 hover:text-slate-700 transition">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-slate-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-slate-500">Kitchen Configurator — Built with Laravel & Livewire</p>
        </div>
    </footer>

    @livewireScripts

    <x-cookie-banner />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
