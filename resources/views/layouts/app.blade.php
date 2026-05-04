<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UNOX Configurator')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'unox-blue': '#0073e1',
                        'unox-dark': '#1a1a1a',
                    }
                }
            }
        }
    </script>
    @livewireStyles
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-unox-blue tracking-tight">UNOX</a>
                    <span class="ml-3 text-sm text-gray-500 hidden sm:inline">Configurator</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/admin" class="text-sm text-gray-600 hover:text-unox-blue transition">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-gray-500">UNOX Configurator — Built with Laravel & Livewire</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
