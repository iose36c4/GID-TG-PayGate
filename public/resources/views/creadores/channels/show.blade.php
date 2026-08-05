@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $channel->name }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $channel->slug }} • {{ $channel->currency }} {{ number_format($channel->price, 2) }}/{{ $channel->billing_cycle }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('creador.channels.edit', $channel) }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-2 px-4 rounded-lg transition-colors">
                Editar
            </a>
            @if($channel->status === 'active')
            <form action="{{ route('creador.channels.update', $channel) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="paused">
                <button type="submit" class="bg-yellow-100 dark:bg-yellow-900/30 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 text-yellow-700 dark:text-yellow-400 font-medium py-2 px-4 rounded-lg transition-colors">
                    Pausar
                </button>
            </form>
            @elseif($channel->status === 'paused')
            <form action="{{ route('creador.channels.update', $channel) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="active">
                <button type="submit" class="bg-green-100 dark:bg-green-900/30 hover:bg-green-200 dark:hover:bg-green-900/50 text-green-700 dark:text-green-400 font-medium py-2 px-4 rounded-lg transition-colors">
                    Activar
                </button>
            </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Información General</h2>
                <dl class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Nombre</dt>
                            <dd class="text-gray-900 dark:text-white font-medium">{{ $channel->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Slug</dt>
                            <dd class="text-gray-900 dark:text-white font-medium font-mono">{{ $channel->slug }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Estado</dt>
                            <dd>
                                @php
                                    $statusColors = [
                                        'draft' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                        'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                        'active' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                        'paused' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                        'archived' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    ];
                                    $statusLabels = [
                                        'draft' => 'Borrador',
                                        'pending' => 'Pendiente',
                                        'active' => 'Activo',
                                        'paused' => 'Pausado',
                                        'archived' => 'Archivado',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$channel->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $statusLabels[$channel->status] ?? $channel->status }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Categoría</dt>
                            <dd class="text-gray-900 dark:text-white">
                                @if($channel->category)
                                    {{ $channel->category->name }}
                                @else
                                    <span class="text-gray-400">Sin categoría</span>
                                @endif
                            </dd>
                        </div>
                        <div class="col-span-2">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Descripción</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $channel->description ?: 'Sin descripción' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Creado</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $channel->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Actualizado</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $channel->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                @if($channel->cover_image)
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Imagen de portada</dt>
                        <dd class="mt-2">
                            <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="Portada" class="max-w-full h-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        </dd>
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Configuración de Telegram</h2>
                <dl class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Bot Username</dt>
                            <dd class="text-gray-900 dark:text-white font-mono">
                                @if($channel->telegram_bot_username)
                                    @{{ $channel->telegram_bot_username }}
                                @else
                                    <span class="text-gray-400">No configurado</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Chat ID</dt>
                            <dd class="text-gray-900 dark:text-white font-mono">
                                @if($channel->telegram_chat_id)
                                    {{ $channel->telegram_chat_id }}
                                @else
                                    <span class="text-gray-400">No configurado</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Invite Link</dt>
                            <dd class="text-gray-900 dark:text-white font-mono text-xs break-all">
                                @if($channel->telegram_invite_link)
                                    {{ $channel->telegram_invite_link }}
                                @else
                                    <span class="text-gray-400">No generado</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Precios y Facturación</h2>
                <dl class="space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Precio</dt>
                            <dd class="text-2xl font-bold text-gray-900 dark:text-white">{{ $channel->currency }} {{ number_format($channel->price, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Ciclo</dt>
                            <dd class="text-gray-900 dark:text-white capitalize">{{ $channel->billing_cycle }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Días de prueba</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $channel->trial_days }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Visibilidad</dt>
                            <dd class="text-gray-900 dark:text-white capitalize">{{ $channel->visibility }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

        <!-- Sidebar Stats -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Estadísticas</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                        <span class="text-gray-600 dark:text-gray-400">Suscriptores</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $channel->subscribers_count }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                        <span class="text-gray-600 dark:text-gray-400">Ingresos totales</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($channel->revenue_total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                        <span class="text-gray-600 dark:text-gray-400">Ingresos este mes</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($channel->subscriptions()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount'), 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-gray-600 dark:text-gray-400">Próximo pago</span>
                        <span class="text-gray-900 dark:text-white font-medium">
                            @if($channel->getActivePayoutSchedule() && $channel->getActivePayoutSchedule()->next_payout_at)
                                {{ $channel->getActivePayoutSchedule()->next_payout_at->format('d/m/Y') }}
                            @else
                                No programado
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Payout Schedule</h2>
                @if($channel->getActivePayoutSchedule())
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-gray-600 dark:text-gray-400">Frecuencia</dt>
                            <dd class="text-gray-900 dark:text-white capitalize">{{ $channel->getActivePayoutSchedule()->frequency }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600 dark:text-gray-400">Mínimo para retiro</dt>
                            <dd class="text-gray-900 dark:text-white">${{ number_format($channel->getActivePayoutSchedule()->minimum_amount, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600 dark:text-gray-400">Comisión plataforma</dt>
                            <dd class="text-gray-900 dark:text-white">{{ ($channel->getActivePayoutSchedule()->platform_fee_percentage * 100) }}%</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600 dark:text-gray-400">Comisión pasarela</dt>
                            <dd class="text-gray-900 dark:text-white">{{ ($channel->getActivePayoutSchedule()->gateway_fee_percentage * 100) }}%</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600 dark:text-gray-400">Fee fijo</dt>
                            <dd class="text-gray-900 dark:text-white">${{ number_format($channel->getActivePayoutSchedule()->fixed_fee, 2) }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">No hay schedule de pagos configurado</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection