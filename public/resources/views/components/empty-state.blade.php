@props(['illustration' => 'empty-search', 'title' => 'No se encontraron resultados', 'description' => 'Intenta ajustar tus filtros o buscar con otros términos', 'ctaText' => 'Limpiar filtros', 'ctaUrl' => route('channels.index')])

<div class="text-center py-16">
    <div class="mx-auto mb-6">
        @switch($illustration)
            @case('empty-search')
            <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            @break
            @case('empty-channels')
            <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            @break
            @case('empty-subscriptions')
            <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            @break
            @default
            <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @endswitch
    </div>

    <h3 class="text-xl font-semibold text-secondary-900 dark:text-white mb-2">{{ $title }}</h3>
    <p class="text-secondary-600 dark:text-secondary-300 mb-6 max-w-md mx-auto">{{ $description }}</p>

    @if($ctaText && $ctaUrl)
    <a href="{{ $ctaUrl }}" class="btn btn--primary">
        {{ $ctaText }}
    </a>
    @endif
</div>