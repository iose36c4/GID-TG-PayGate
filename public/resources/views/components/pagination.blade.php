@props(['paginator'])

@if($paginator->hasPages())
<nav class="flex items-center justify-center gap-2" aria-label="Paginación">
    {{-- Previous --}}
    @if($paginator->onFirstPage())
    <button type="button" class="btn btn--ghost btn--sm px-3" disabled aria-label="Página anterior">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn--ghost btn--sm px-3" aria-label="Página anterior">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </a>
    @endif

    {{-- Page numbers --}}
    @foreach($elements = $paginator->elements() as $element)
        @if(is_string($element))
        <span class="px-3 py-1 text-secondary-500 dark:text-secondary-400">...</span>
        @else
        @if($element['page'] == $paginator->currentPage())
        <button type="button" class="btn btn--primary btn--sm px-4" aria-current="page" aria-label="Página {{ $element['page'] }, actual">
            {{ $element['page'] }}
        </button>
        @else
        <a href="{{ $element['url'] }}" class="btn btn--ghost btn--sm px-4" aria-label="Página {{ $element['page'] }}">
            {{ $element['page'] }}
        </a>
        @endif
    @endforeach

    {{-- Next --}}
    @if($paginator->onLastPage())
    <button type="button" class="btn btn--ghost btn--sm px-3" disabled aria-label="Página siguiente">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
    @else
    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn--ghost btn--sm px-3" aria-label="Página siguiente">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
    @endif
</nav>

<p class="mt-4 text-center text-sm text-secondary-500 dark:text-secondary-400">
    Mostrando {{ $paginator->firstItem() }} a {{ $paginator->lastItem() }} de {{ $paginator->total() }} resultados
</p>
@endif