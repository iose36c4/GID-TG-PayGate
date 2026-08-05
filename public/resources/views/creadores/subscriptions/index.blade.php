@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Gestión de Suscripciones</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Administra las suscripciones de tus canales</p>
    </div>

    <!-- Filtros -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Buscar</label>
                <input type="text" name="search" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Usuario, email..." value="{{ request('search') }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    <option value="">Todos</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activas</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Canceladas</option>
                    <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expiradas</option>
                    <option value="trial" {{ request('status') === 'trial' ? 'selected' : '' }}>En prueba</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Canal</label>
                <select name="channel_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    <option value="">Todos los canales</option>
                    @foreach($channels as $channel)
                    <option value="{{ $channel->id }}" {{ request('channel_id') == $channel->id ? 'selected' : '' }}>
                        {{ $channel->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Filtrar
                </button>
                <a href="{{ route('creadores.subscriptions.index') }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Tabla Suscripciones -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        @if($subscriptions->isEmpty())
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No hay suscripciones</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6">No se encontraron suscripciones con los filtros actuales.</p>
            <a href="{{ route('creadores.channels.index') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-6 rounded-lg transition-colors inline-block">
                Ver mis canales
            </a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="p-4 text-left text-sm font-semibold text-gray-500 dark:text-gray-400">Suscriptor</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Canal</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Estado</th>
                        <th class="p-4 text-right text-sm font-semibold text-gray-500 dark:text-gray-400">Precio</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Ciclo</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Inicio</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Renovación</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($subscriptions as $subscription)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
                                        {{ strtoupper($subscription->user->name[0]) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $subscription->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $subscription->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            <a href="{{ route('creadores.channels.show', $subscription->channel) }}" class="hover:underline text-primary-600 dark:text-primary-400">
                                {{ $subscription->channel->name }}
                            </a>
                        </td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $subscription->getStatusBadgeClass() }}">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-right text-sm font-medium text-gray-900 dark:text-white">
                            {{ $subscription->currency }} {{ number_format($subscription->price, 2) }}
                        </td>
                        <td class="p-4 text-center text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $subscription->billing_cycle }}</td>
                        <td class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">{{ $subscription->created_at->format('d/m/Y') }}</td>
                        <td class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">{{ $subscription->renews_at?->format('d/m/Y') ?? '—' }}</td>
                        <td class="p-4 text-center space-x-2">
                            <a href="{{ route('creadores.subscriptions.show', $subscription) }}" class="text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 text-sm font-medium" title="Ver detalle">
                                Ver
                            </a>
                            @if($subscription->status === 'active')
                            <form action="{{ route('creadores.subscriptions.cancel', $subscription) }}" method="POST" class="inline" onsubmit="return confirm('¿Cancelar esta suscripción?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 text-sm font-medium" title="Cancelar">
                                    Cancelar
                                </button>
                            </form>
                            @endif
                            @if($subscription->status === 'cancelled' || $subscription->status === 'expired')
                            <form action="{{ route('creadores.subscriptions.renew', $subscription) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 text-sm font-medium" title="Renovar">
                                    Renovar
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            {{ $subscriptions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection