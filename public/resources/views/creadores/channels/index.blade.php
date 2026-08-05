@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Mis Canales</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Gestiona tus canales de pago exclusivos</p>
        </div>
        <a href="{{ route('creador.channels.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Canal
        </a>
    </div>

    @if($channels->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No tienes canales creados</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Crea tu primer canal de pago para empezar a monetizar tu contenido.</p>
            <a href="{{ route('creador.channels.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-block">
                Crear tu primer canal
            </a>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Canal</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Categoría</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Estado</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Suscriptores</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Precio</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Ingresos</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500 dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($channels as $channel)
                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    @if($channel->cover_image)
                                        <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $channel->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $channel->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($channel->category)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full"
                                        style="background-color: {{ $channel->category->color ?? '#e0f2fe' }}20; color: {{ $channel->category->color ?? '#0284c7' }};">
                                        @if($channel->category->icon)
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        @endif
                                        {{ $channel->category->name }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-400 dark:text-gray-500">Sin categoría</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
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
                            </td>
                            <td class="py-4 px-6 text-gray-900 dark:text-white">{{ $channel->subscribers_count }}</td>
                            <td class="py-4 px-6 text-gray-900 dark:text-white">{{ $channel->currency }} {{ number_format($channel->price, 2) }}/{{ $channel->billing_cycle }}</td>
                            <td class="py-4 px-6 text-gray-900 dark:text-white">${{ number_format($channel->revenue_total, 2) }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('creador.channels.show', $channel) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Ver</a>
                                    <a href="{{ route('creador.channels.edit', $channel) }}" class="text-gray-600 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 text-sm font-medium">Editar</a>
                                    @if($channel->status === 'active')
                                    <form action="{{ route('creador.channels.update', $channel) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="paused">
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-700 text-sm font-medium">Pausar</button>
                                    </form>
                                    @elseif($channel->status === 'paused')
                                    <form action="{{ route('creador.channels.update', $channel) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="text-green-600 hover:text-green-700 text-sm font-medium">Activar</button>
                                    </form>
                                    @endif
                                    <form action="{{ route('creador.channels.destroy', $channel) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este canal?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $channels->links() }}
            </div>
        </div>
    @endif
</div>
@endsection