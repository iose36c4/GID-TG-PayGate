<x-layouts.install title="Ejecutar Migraciones" step="3">
    <div class="space-y-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ejecutar Migraciones</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Se crearán las tablas necesarias en la base de datos configurada.
            </p>
        </div>

        @if (empty($output))
            <form method="POST" class="space-y-4">
                @csrf
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center">
                    Ejecutar Migraciones
                </button>
            </form>
        @else
            <div class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-sm max-h-96 overflow-y-auto">
                @foreach ($output as $line)
                    <div>{{ $line }}</div>
                @endforeach
            </div>

            @if ($exitCode === 0)
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <p class="text-green-800 dark:text-green-200 font-medium">¡Migraciones completadas correctamente!</p>
                </div>
                <form method="POST" class="space-y-4">
                    @csrf
                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center">
                        Continuar a Cuenta de Administrador
                    </button>
                </form>
            @else
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <p class="text-red-800 dark:text-red-200 font-medium">Error en las migraciones. Revisa la configuración de la base de datos.</p>
                </div>
                <a href="{{ route('install.database') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center block">
                    Volver a Configuración
                </a>
            @endif
        @endif
    </div>
</x-layouts.install>