<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('tgp-dark') === '1' }" :class="dark ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cuenta') - {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">

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
                            },
                            accent: {
                                50: '#fdf4ff',
                                100: '#fae8ff',
                                200: '#f5d0fe',
                                300: '#f0abfc',
                                400: '#e879f9',
                                500: '#d946ef',
                                600: '#c026d3',
                                700: '#a21caf',
                                800: '#86198f',
                                900: '#701a75',
                                950: '#4a044e',
                            },
                            secondary: {
                                50: '#f8fafc',
                                100: '#f1f5f9',
                                200: '#e2e8f0',
                                300: '#cbd5e1',
                                400: '#94a3b8',
                                500: '#64748b',
                                600: '#475569',
                                700: '#334155',
                                800: '#1e293b',
                                900: '#0f172a',
                                950: '#020617',
                            }
                        }
                    }
                }
            }
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
    @stack('head')
</head>
<body class="bg-secondary-50 dark:bg-secondary-950 text-secondary-900 dark:text-secondary-100 antialiased min-h-screen flex flex-col"
      x-init="() => { document.documentElement.classList.toggle('dark', dark) }">
    <div class="flex flex-col min-h-screen">
        <header class="sticky top-0 z-50 bg-white/90 dark:bg-secondary-950/90 backdrop-blur border-b border-secondary-200 dark:border-secondary-800">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ route('home') }}" class="flex items-center gap-2" aria-label="TG-PayGate - Inicio">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-accent-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-secondary-900 dark:text-white">TG-PayGate</span>
                    </a>

                    <div class="flex items-center gap-3">
                        <button type="button" x-on:click="dark = !dark; localStorage.setItem('tgp-dark', dark ? '1' : '0')"
                                class="p-2 rounded-lg text-secondary-600 dark:text-secondary-300 hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors"
                                :aria-label="dark ? 'Activar modo claro' : 'Activar modo oscuro'">
                            <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <svg x-show="dark" class="w-5 h-5" style="display: none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>
                        <a href="{{ route('home') }}" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            Inicio
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-secondary-900 rounded-2xl border border-secondary-200 dark:border-secondary-800 shadow-sm p-8">
                    @yield('content')
                </div>
                <p class="text-center text-sm text-secondary-500 dark:text-secondary-400 mt-6">
                    <a href="{{ route('home') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">&larr; Volver al inicio</a>
                </p>
            </div>
        </main>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
