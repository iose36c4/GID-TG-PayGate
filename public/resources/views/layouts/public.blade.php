<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('tgp-dark') === '1', mobileOpen: false }" :class="dark ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TG-PayGate') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'TG-PayGate: vende accesos a tus canales de Telegram, automatiza pagos y genera invitaciones únicas sin complicaciones.')">
    <meta name="keywords" content="telegram, canales de pago, monetizar telegram, venta de accesos, suscripciones">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@yield('og_title', 'TG-PayGate - Monetiza tu canal de Telegram')">
    <meta property="og:description" content="@yield('og_description', 'Vende accesos a tus canales de Telegram y automatiza pagos e invitaciones únicas.')">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'TG-PayGate - Monetiza tu canal de Telegram')">
    <meta name="twitter:description" content="@yield('og_description', 'Vende accesos a tus canales de Telegram y automatiza pagos e invitaciones únicas.')">

    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

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

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ config('app.name') }}",
        "url": "{{ url('/') }}",
        "description": "Plataforma para vender accesos a canales de Telegram.",
        "sameAs": []
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "{{ config('app.name') }}",
        "url": "{{ url('/') }}"
    }
    </script>
    @stack('head')
</head>
<body class="bg-white dark:bg-secondary-950 text-secondary-900 dark:text-secondary-100 antialiased min-h-screen flex flex-col" x-init="() => { document.documentElement.classList.toggle('dark', dark) }">
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

                    <nav class="hidden md:flex items-center gap-6" aria-label="Navegación principal">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Inicio</a>
                        <a href="#features" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Características</a>
                        <a href="#pricing" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Precios</a>
                        <a href="#faq" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">FAQ</a>
                        <a href="{{ route('contact') }}" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Contacto</a>
                    </nav>

                    <div class="hidden md:flex items-center gap-3">
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

                        @auth
                            <a href="{{ auth()->user()->isCreador() ? route('creador.dashboard') : route('creador.dashboard') }}" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                Mi Panel
                            </a>
                        @else
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-sm font-medium text-secondary-700 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    Iniciar Sesión
                                </a>
                            @endif
                            <a href="{{ Route::has('register') ? route('register') : route('home').'#pricing' }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                                Registrarse
                            </a>
                        @endauth
                    </div>

                    <button type="button" class="md:hidden p-2 rounded-lg text-secondary-600 dark:text-secondary-300 hover:bg-secondary-100 dark:hover:bg-secondary-800 transition-colors"
                            x-on:click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen ? 'true' : 'false'" aria-label="Abrir menú">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-cloak x-transition class="md:hidden border-t border-secondary-200 dark:border-secondary-800 bg-white dark:bg-secondary-950">
                <div class="container mx-auto px-4 py-4 flex flex-col gap-2">
                    <a href="{{ route('home') }}" class="py-2 text-sm font-medium text-secondary-700 dark:text-secondary-300">Inicio</a>
                    <a href="#features" class="py-2 text-sm font-medium text-secondary-700 dark:text-secondary-300">Características</a>
                    <a href="#pricing" class="py-2 text-sm font-medium text-secondary-700 dark:text-secondary-300">Precios</a>
                    <a href="#faq" class="py-2 text-sm font-medium text-secondary-700 dark:text-secondary-300">FAQ</a>
                    <a href="{{ route('contact') }}" class="py-2 text-sm font-medium text-secondary-700 dark:text-secondary-300">Contacto</a>
                    <div class="pt-2 border-t border-secondary-200 dark:border-secondary-800 flex items-center gap-3">
                        @auth
                            <a href="{{ route('creador.dashboard') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                                Mi Panel
                            </a>
                        @else
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-sm font-medium text-secondary-700 dark:text-secondary-300">Iniciar Sesión</a>
                            @endif
                            <a href="{{ Route::has('register') ? route('register') : route('home').'#pricing' }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                                Registrarse
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="bg-secondary-900 dark:bg-secondary-950 text-secondary-300 border-t border-secondary-800">
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-white font-semibold mb-4">Producto</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#features" class="hover:text-white transition-colors">Características</a></li>
                            <li><a href="#pricing" class="hover:text-white transition-colors">Precios</a></li>
                            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Canales</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-4">Empresa</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Acerca de</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Soporte</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-4">Legal</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">Términos y Condiciones</a></li>
                            <li><a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Política de Privacidad</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-4">Newsletter</h3>
                        <p class="text-sm text-secondary-400 mb-4">Recibe novedades y consejos para monetizar tu audiencia.</p>
                        <form action="{{ Route::has('newsletter.subscribe') ? route('newsletter.subscribe') : '#' }}" method="POST" class="flex gap-2">
                            @csrf
                            <label class="sr-only" for="newsletter-email">Email</label>
                            <input type="email" name="email" id="newsletter-email" placeholder="tu@email.com" required
                                   class="flex-1 min-w-0 px-3 py-2 text-sm bg-secondary-800 border border-secondary-700 rounded-lg text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <button type="submit" class="px-4 py-2 text-sm font-medium bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                                Suscribir
                            </button>
                        </form>
                    </div>
                </div>
                <div class="mt-10 pt-6 border-t border-secondary-800 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-secondary-400">&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
                    <div class="flex items-center gap-4 text-sm">
                        <a href="{{ route('terms') }}" class="text-secondary-400 hover:text-white transition-colors">Términos</a>
                        <a href="{{ route('privacy') }}" class="text-secondary-400 hover:text-white transition-colors">Privacidad</a>
                        <a href="{{ route('contact') }}" class="text-secondary-400 hover:text-white transition-colors">Contacto</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
