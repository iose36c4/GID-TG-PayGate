<nav aria-label="Breadcrumb" class="mb-4" x-data="breadcrumbs()">
    <ol class="flex items-center space-x-2 text-sm" role="list">
        <li>
            <a href="{{ route('home') }}" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Inicio
            </a>
        </li>
        <template x-for="(crumb, index) in crumbs" :key="index">
            <li>
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                <template x-if="index < crumbs.length - 1">
                    <a :href="crumb.url" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors" x-text="crumb.label"></a>
                </template>
                <template x-if="index === crumbs.length - 1">
                    <span class="text-gray-900 dark:text-white font-medium" x-text="crumb.label"></span>
                </template>
            </li>
        </template>
    </ol>
</nav>

<script>
    function breadcrumbs() {
        return {
            crumbs: [],
            init() {
                // Generate breadcrumbs from current route
                const path = window.location.pathname;
                const segments = path.split('/').filter(s => s);
                let currentPath = '';
                
                this.crumbs = segments.map((segment, index) => {
                    currentPath += '/' + segment;
                    // Try to get a readable label from the segment
                    let label = segment.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                    // Remove IDs (numbers) from label
                    if (/^\d+$/.test(segment)) {
                        label = 'Detalle';
                    }
                    return { label, url: currentPath };
                });
            }
        }
    }
</script>