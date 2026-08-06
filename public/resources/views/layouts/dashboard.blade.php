<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('tgp-dark') === '1', sidebarOpen: false }" :class="dark ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'TG-PayGate' }} - {{ config('app.name') }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                200: '#bae6fd',
                                300: '#7dd3fc',
                                400: '#38bdf8',
                                500: '#0ea5e9',
                                600: '#0284c7',
                                700: '#0369a1',
                                800: '#075985',
                                900: '#0c4a6e',
                                950: '#082f49',
                            }
                        }
                    }
                }
            }
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen" x-init="() => { document.documentElement.classList.toggle('dark', dark) }">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">TG-PayGate</span>
                    </a>

                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Abrir menú" aria-expanded="false">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Navigation (Desktop) -->
                    <nav class="hidden md:flex items-center gap-6" aria-label="Navegación principal">
                        @yield('header-nav')
                    </nav>

                    <!-- User Menu -->
                    <div class="flex items-center gap-4">
                        @auth
                        <div class="relative" id="user-menu-button">
                            <button @click="toggleUserMenu()" class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-expanded="false" aria-haspopup="true">
                                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
                                        {{ strtoupper(auth()->user()->name[0]) }}
                                    </span>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 hidden sm:block">
                                    {{ auth()->user()->name }}
                                </span>
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div id="user-menu" x-show="userMenuOpen" x-transition @click.outside="userMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50 hidden" role="menu">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                    Perfil
                                </a>
                                <hr class="my-1 border-gray-200 dark:border-gray-700">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Sidebar (Desktop) -->
        <aside class="hidden lg:block w-64 bg-white dark:bg-gray-950 border-r border-gray-200 dark:border-gray-800 fixed lg:static inset-y-0 left-0 z-30 transform transition-transform duration-200"
               :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
               aria-label="Navegación lateral">
            <nav class="p-4 space-y-1" aria-label="Menú principal">
                @yield('sidebar-nav')
            </nav>
        </aside>

        <!-- Mobile sidebar overlay -->
        <div class="lg:hidden fixed inset-0 z-20 bg-black/50" 
             :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
             @click="sidebarOpen = false" aria-hidden="true"></div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-0 min-h-screen" :class="{ 'lg:ml-64': true }">
            {{-- Topbar --}}
            <header class="sticky top-0 z-20 bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="container mx-auto px-4 h-16 flex items-center justify-between">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Abrir menú">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="flex-1 lg:hidden"></div>
                    <div class="flex items-center gap-4">
                        @yield('topbar-actions')
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" aria-expanded="false" aria-haspopup="true">
                                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
                                        {{ auth()->user()->name[0] ?? 'U' }}
                                    </span>
                                </div>
                                <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="userMenuOpen" x-transition @click.outside="userMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1" role="menu">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Perfil</a>
                                <hr class="my-1 border-gray-200 dark:border-gray-700">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Cerrar sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main id="main-content" class="container mx-auto px-4 py-6" role="main">
                @include('components.breadcrumbs')
                @yield('page-header')
                @yield('content')
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} TG-PayGate. Todos los derechos reservados.
                    </p>
                    <div class="flex items-center gap-6">
                        <a href="{{ route('terms') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            Términos
                        </a>
                        <a href="{{ route('privacy') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            Privacidad
                        </a>
                        <a href="{{ route('contact') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            Contacto
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('user-menu');
            if (menu) menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('user-menu');
            const button = document.getElementById('user-menu-button');
            if (menu && button && !button.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>