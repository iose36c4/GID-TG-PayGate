@props(['channel'])

<article class="channel-card bg-white dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
    <div class="relative aspect-video overflow-hidden">
        @if($channel->cover_image)
        <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="{{ $channel->name }}"
             class="w-full h-full object-cover" loading="lazy">
        @else
        <div class="w-full h-full bg-gradient-to-br from-primary-100 to-accent-100 dark:from-primary-900 dark:to-accent-900 flex items-center justify-center">
            <svg class="w-16 h-16 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
        </div>
        @endif

        <div class="absolute top-3 right-3 flex gap-2">
            <span class="badge badge--success badge--sm">
                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                {{ $channel->subscribers_count ?? 0 }} suscriptores
            </span>
        </div>
    </div>

    <div class="p-6 flex flex-col flex-1">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-6 h-6 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                <span class="text-xs font-medium text-primary-700 dark:text-primary-300">
                    {{ strtoupper($channel->owner->name[0] ?? 'U') }}
                </span>
            </div>
            <span class="text-sm text-secondary-500 dark:text-secondary-400">{{ $channel->owner->name ?? 'Creador' }}</span>
        </div>

        <h3 class="text-lg font-semibold text-secondary-900 dark:text-white mb-1 line-clamp-1">
            <a href="{{ route('channels.show', $channel) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                {{ $channel->name }}
            </a>
        </h3>

        @if($channel->description)
        <p class="text-secondary-600 dark:text-secondary-300 text-sm mb-4 line-clamp-2">{{ $channel->description }}</p>
        @endif

        <div class="flex items-center justify-between pt-4 border-t border-secondary-200 dark:border-secondary-700 mt-auto">
            <div>
                <p class="text-xl font-bold text-secondary-900 dark:text-white">
                    {{ number_format($channel->price, 0, ',', '.') }} {{ $channel->currency }}
                </p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 capitalize">{{ $channel->billing_cycle }}/mes</p>
            </div>
            <a href="{{ route('channels.show', $channel) }}" class="btn btn--primary btn--sm">
                Ver detalles
            </a>
        </div>
    </div>
</article>