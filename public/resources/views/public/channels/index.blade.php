@extends('layouts.public')

@section('title', 'Canales de pago - TG-PayGate')

@section('meta_description', 'Descubre canales premium de Telegram. Filtra por categoría, busca por temática y accede a contenido exclusivo.')

@section('og_title', 'Canales de pago - TG-PayGate')

@section('og_description', 'Descubre canales premium de Telegram. Filtra por categoría y accede a contenido exclusivo.')

@section('content')
<!-- Page Header -->
<section class="py-16 bg-secondary-50 dark:bg-secondary-900">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-secondary-900 dark:text-white mb-4">Descubre canales premium</h1>
            <p class="text-lg text-secondary-600 dark:text-secondary-300">Encuentra contenido exclusivo de tus creadores favoritos. Acceso instantáneo tras el pago.</p>
        </div>
    </div>
</section>

<!-- Filters & Grid -->
<section class="py-12 bg-white dark:bg-secondary-950">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:w-64 flex-shrink-0">
                <form method="GET" action="{{ route('channels.index') }}" class="space-y-6">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">Buscar</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               placeholder="Nombre, descripción..."
                               class="w-full px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">Categoría</label>
                        <select name="category" id="category"
                                class="w-full px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit/Reset -->
                    <div class="flex flex-col gap-2 pt-4 border-t border-secondary-200 dark:border-secondary-700">
                        <button type="submit" class="btn btn--primary w-full">Filtrar</button>
                        @if(request()->hasAny(['search', 'category']))
                        <a href="{{ route('channels.index') }}" class="btn btn--ghost w-full">Limpiar filtros</a>
                        @endif
                    </div>
                </form>
            </aside>

            <!-- Channels Grid -->
            <main class="flex-1">
                @if($channels->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($channels as $channel)
                    <article class="channel-card bg-white dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                        @if($channel->cover_image)
                        <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="{{ $channel->name }}"
                             class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-primary-100 to-accent-100 dark:from-primary-900 dark:to-accent-900 flex items-center justify-center">
                            <svg class="w-16 h-16 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        @endif

                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                @if($channel->category)
                                <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 rounded-full">
                                    {{ $channel->category->name }}
                                </span>
                                @endif
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">
                                    Activo
                                </span>
                            </div>

                            <h2 class="text-xl font-bold text-secondary-900 dark:text-white mb-2">{{ $channel->name }}</h2>

                            @if($channel->description)
                            <p class="text-secondary-600 dark:text-secondary-300 text-sm mb-4 line-clamp-2">{{ $channel->description }}</p>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-secondary-200 dark:border-secondary-700 mt-auto">
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-secondary-900 dark:text-white">
                                        {{ number_format($channel->price, 0, ',', '.') }} {{ $channel->currency }}
                                    </p>
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400 capitalize">{{ $channel->billing_cycle }}</p>
                                </div>
                                <a href="{{ route('channels.show', $channel) }}" class="btn btn--primary btn--sm">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $channels->links() }}
                </div>
                @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-secondary-900 dark:text-white mb-2">No hay canales disponibles</h3>
                    <p class="text-secondary-600 dark:text-secondary-300 mb-6">Intenta cambiar los filtros o busca con otros términos.</p>
                    <a href="{{ route('channels.index') }}" class="btn btn--primary">Ver todos los canales</a>
                </div>
                @endif
            </main>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">¿Eres creador?</h2>
        <p class="text-primary-100 mb-8 max-w-2xl mx-auto">Monetiza tu canal de Telegram hoy mismo. Setup en 5 minutos, sin costos iniciales.</p>
        <a href="{{ route('register') }}" class="btn btn--lg bg-white text-primary-700 hover:bg-primary-50 px-8 py-3">
            Crear mi canal gratis
        </a>
    </div>
</section>
@endsection