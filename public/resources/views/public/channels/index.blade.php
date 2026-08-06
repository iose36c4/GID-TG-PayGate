@extends('layouts.public')

@section('title', 'Canales de pago - TG-PayGate')

@section('meta_description', 'Descubre canales premium de Telegram. Filtra por categoría, busca por temática y accede a contenido exclusivo.')

@section('og_title', 'Canales de pago - TG-PayGate')

@section('og_description', 'Descubre canales premium de Telegram. Filtra por categoría y accede a contenido exclusivo.')

@section('head')
<script type="application/ld+json">
{!! json_encode($itemList, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

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
                <form method="GET" action="{{ route('channels.index') }}" class="space-y-6" x-data="filters()">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">Buscar</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               placeholder="Nombre, descripción..."
                               class="w-full px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500"
                               x-model.debounce.300ms="filters.search">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">Categoría</label>
                        <select name="category" id="category"
                                class="w-full px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                                x-model="filters.category">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">Precio (mensual)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="price_min" min="0" step="1" value="{{ request('price_min') }}" placeholder="Mín"
                                   class="flex-1 px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                   x-model.number.debounce.300ms="filters.price_min">
                            <input type="number" name="price_max" min="0" step="1" value="{{ request('price_max') }}" placeholder="Máx"
                                   class="flex-1 px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                   x-model.number.debounce.300ms="filters.price_max">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">Ordenar por</label>
                        <select name="sort" id="sort"
                                class="w-full px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                                x-model="filters.sort">
                            <option value="popular">Más populares</option>
                            <option value="newest">Más recientes</option>
                            <option value="price_asc">Precio: menor a mayor</option>
                            <option value="price_desc">Precio: mayor a menor</option>
                        </select>
                    </div>

                    <!-- Submit/Reset -->
                    <div class="flex flex-col gap-2 pt-4 border-t border-secondary-200 dark:border-secondary-700">
                        <button type="submit" class="btn btn--primary w-full">Filtrar</button>
                        @if(request()->hasAny(['search', 'category', 'price_min', 'price_max', 'sort']))
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
                    <x-channel-card :channel="$channel" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <x-pagination :paginator="$channels" />
                </div>
                @else
                <x-empty-state
                    illustration="empty-search"
                    title="No se encontraron canales"
                    description="Intenta cambiar los filtros o busca con otros términos."
                    ctaText="Limpiar filtros"
                    ctaUrl="{{ route('channels.index') }}"
                />
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

@push('scripts')
<script>
    function filters() {
        return {
            filters: {
                search: '{{ request("search") }}',
                category: '{{ request("category") }}',
                price_min: {{ request("price_min") ?? 'null' }},
                price_max: {{ request("price_max") ?? 'null' }},
                sort: '{{ request("sort", "popular") }}',
            },
            submitForm() {
                const params = new URLSearchParams();
                Object.entries(this.filters).forEach(([key, value]) => {
                    if (value !== '' && value !== null) {
                        params.set(key, value);
                    }
                });
                window.location.href = '{{ route("channels.index") }}?' + params.toString();
            }
        }
    }
</script>
@endpush