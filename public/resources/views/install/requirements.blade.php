<x-layouts.install title="Requisitos del Sistema" step="1">
    <div class="space-y-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Comprobación de Requisitos</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                El sistema verificará que tu servidor cumple con los requisitos mínimos para ejecutar TG-PayGate.
            </p>
        </div>

        <div class="space-y-3">
            @foreach ($checks as $name => $passed)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $name }}</span>
                    @if ($passed)
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            @php($allPassed = collect($checks)->every(fn($v) => $v))
            @if ($allPassed)
                <a href="{{ route('install.database') }}" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-lg transition-colors text-center block">
                    Continuar a Configuración de Base de Datos
                </a>
            @else
                <button disabled class="w-full bg-gray-400 text-white font-medium py-3 px-4 rounded-lg text-center block cursor-not-allowed">
                    Corrige los errores antes de continuar
                </button>
            @endif
        </div>
    </div>
</x-layouts.install>