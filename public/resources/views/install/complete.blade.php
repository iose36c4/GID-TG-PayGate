<x-layouts.install title="Instalación Completada" step="4">
    <div class="space-y-6 text-center">
        <div class="mx-auto h-16 w-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
            <svg class="h-10 w-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">¡Instalación Completada!</h2>
            <p class="text-gray-600 dark:text-gray-400">
                TG-PayGate se ha instalado correctamente. Tu cuenta de administrador está lista.
            </p>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 space-y-4 text-left">
            <h3 class="font-semibold text-gray-900 dark:text-white">Próximos Pasos:</h3>
            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                <li class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-primary-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Accede al panel de administración en <a href="{{ url('/admin') }}" class="text-primary-600 hover:underline">/admin</a>
                </li>
                <li class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-primary-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Configura tu bot de Telegram en <a href="{{ url('/creador/settings/bot') }}" class="text-primary-600 hover:underline">Configuración de Bot</a>
                </li>
                <li class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-primary-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Crea tu primer canal de pago en <a href="{{ url('/creador/channels/create') }}" class="text-primary-600 hover:underline">Crear Canal</a>
                </li>
            </ul>
        </div>

        <a href="{{ url('/') }}" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center block">
            Ir al Inicio
        </a>
    </div>
</x-layouts.install>