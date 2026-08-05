@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Paso 4 de 4</p>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Precios y Planes</h1>
            </div>
        </div>

        <form action="{{ route('creadores.onboarding.step4.store', $channel) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Configuración de Precios</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio</label>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-500 dark:text-gray-400">{{ $channel->currency ?? 'ARS' }}</span>
                            <input type="number" name="price" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0.00" required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Moneda</label>
                            <select name="currency" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                                <option value="ARS" {{ ($channel->currency ?? 'ARS') === 'ARS' ? 'selected' : '' }}>ARS - Peso Argentino</option>
                                <option value="USD" {{ ($channel->currency ?? '') === 'USD' ? 'selected' : '' }}>USD - Dólar Americano</option>
                                <option value="EUR" {{ ($channel->currency ?? '') === 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ciclo de Facturación</label>
                            <select name="billing_cycle" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                                <option value="monthly" {{ ($channel->billing_cycle ?? 'monthly') === 'monthly' ? 'selected' : '' }}>Mensual</option>
                                <option value="quarterly" {{ ($channel->billing_cycle ?? '') === 'quarterly' ? 'selected' : '' }}>Trimestral</option>
                                <option value="yearly" {{ ($channel->billing_cycle ?? '') === 'yearly' ? 'selected' : '' }}>Anual</option>
                                <option value="lifetime" {{ ($channel->billing_cycle ?? '') === 'lifetime' ? 'selected' : '' }}>Pago único (Lifetime)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Días de prueba</label>
                            <input type="number" name="trial_days" min="0" max="365" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="0" value="{{ $channel->trial_days ?? 0 }}">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">0 = sin prueba gratuita</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-lg">
                    <h4 class="font-medium text-primary-800 dark:text-primary-200 mb-2">Resumen de comisiones</h4>
                    <ul class="text-sm text-primary-700 dark:text-primary-300 space-y-1">
                        <li>• Comisión de plataforma: <strong>5%</strong></li>
                        <li>• Comisión de pasarela de pago: <strong>3.5%</strong></li>
                        <li>• Fee fijo por pago: <strong>$50 ARS</strong></li>
                        <li>• Pago mínimo para retiro: <strong>$1.000 ARS</strong></li>
                    </ul>
                    <p class="mt-2 text-xs text-primary-600 dark:text-primary-400">Estos valores son configurables después en la sección de pagos.</p>
                </div>
            </div>

            <div class="flex justify-between gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('creadores.onboarding.step3', $channel) }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver
                </a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2 ms-auto">
                    Finalizar Onboarding
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection