<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TG-PayGate - Instalador' }}</title>
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
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            <div>
                <div class="mx-auto h-12 w-12 bg-primary-600 rounded-xl flex items-center justify-center">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h1 class="mt-6 text-center text-3xl font-bold text-gray-900 dark:text-white">{{ $title ?? 'TG-PayGate' }}</h1>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">Instalador - Paso {{ $step ?? 1 }} de 4</p>
            </div>
            <div class="bg-white dark:bg-gray-800 py-8 px-6 shadow-xl rounded-xl sm:px-10">
                {{ $slot }}
            </div>
            <p class="text-center text-xs text-gray-500 dark:text-gray-500">
                TG-PayGate &copy; {{ date('Y') }}
            </p>
        </div>
    </div>
</body>
</html>