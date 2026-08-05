@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Editar Canal</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $channel->name }}</p>
    </div>

    <form action="{{ route('creador.channels.update', $channel) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Información del Canal</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Canal</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ $channel->name }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Slug (URL amigable)</label>
                    <input type="text" name="slug" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ $channel->slug }}" pattern="[a-z0-9-]+">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Solo minúsculas, números y guiones.</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                    <textarea name="description" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" rows="4">{{ $channel->description }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                    <select name="category_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $channel->category_id === $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagen de portada</label>
                    @if($channel->cover_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="Portada actual" class="max-w-xs h-auto rounded-lg border border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Imagen actual</p>
                        </div>
                    @endif
                    <input type="file" name="cover_image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Máx 2MB. JPG, PNG o WebP. Dejar vacío para mantener la actual.</p>
                    @error('cover_image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Chat ID de Telegram</label>
                    <input type="number" name="telegram_chat_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ $channel->telegram_chat_id }}" placeholder="-1001234567890">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">ID del grupo/canal de Telegram. Formato: -100xxxxxxxxxx</p>
                    @error('telegram_chat_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Token del Bot (opcional)</label>
                    <input type="password" name="telegram_bot_token" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Dejar vacío para no cambiar" autocomplete="new-password">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Solo completa si quieres actualizar el token. Se cifra con AES-256.</p>
                    @error('telegram_bot_token')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Precios y Configuración</h3>
            <div class="space-y-4">
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio</label>
                        <input type="number" name="price" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ $channel->price }}" required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Moneda</label>
                        <select name="currency" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                            <option value="ARS" {{ $channel->currency === 'ARS' ? 'selected' : '' }}>ARS - Peso Argentino</option>
                            <option value="USD" {{ $channel->currency === 'USD' ? 'selected' : '' }}>USD - Dólar Americano</option>
                            <option value="EUR" {{ $channel->currency === 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ciclo de Facturación</label>
                        <select name="billing_cycle" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                            <option value="monthly" {{ $channel->billing_cycle === 'monthly' ? 'selected' : '' }}>Mensual</option>
                            <option value="quarterly" {{ $channel->billing_cycle === 'quarterly' ? 'selected' : '' }}>Trimestral</option>
                            <option value="yearly" {{ $channel->billing_cycle === 'yearly' ? 'selected' : '' }}>Anual</option>
                            <option value="lifetime" {{ $channel->billing_cycle === 'lifetime' ? 'selected' : '' }}>Pago único (Lifetime)</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Días de prueba</label>
                        <input type="number" name="trial_days" min="0" max="365" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" value="{{ $channel->trial_days }}">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">0 = sin prueba gratuita</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="draft" {{ $channel->status === 'draft' ? 'selected' : '' }}>Borrador</option>
                            <option value="pending" {{ $channel->status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                            <option value="active" {{ $channel->status === 'active' ? 'selected' : '' }}>Activo</option>
                            <option value="paused" {{ $channel->status === 'paused' ? 'selected' : '' }}>Pausado</option>
                            <option value="archived" {{ $channel->status === 'archived' ? 'selected' : '' }}>Archivado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('creador.channels.show', $channel) }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Cancelar
            </a>
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2 ms-auto">
                Guardar Cambios
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection