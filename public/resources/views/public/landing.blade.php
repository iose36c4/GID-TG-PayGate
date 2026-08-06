@extends('layouts.public')

@section('title', 'TG-PayGate - Monetiza tu canal de Telegram')

@section('meta_description', 'Vende accesos a tus canales de Telegram y automatiza pagos e invitaciones únicas. Integración con MercadoPago, Stripe y PayPal. Facturación AFIP automática.')

@section('og_title', 'TG-PayGate - Monetiza tu canal de Telegram')

@section('og_description', 'Vende accesos a tus canales de Telegram y automatiza pagos e invitaciones únicas.')

@section('og_type', 'website')

@section('canonical', url('/'))

@section('content')
<!-- Hero Section -->
<section class="hero relative overflow-hidden bg-gradient-to-b from-primary-50 to-white dark:from-secondary-900 dark:to-secondary-950">
    <div class="container mx-auto px-4 py-20 lg:py-32">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-block px-3 py-1 rounded-full bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 text-sm font-medium mb-6">
                Nuevo: Monetiza tu canal de Telegram en minutos
            </span>
            <h1 class="text-4xl lg:text-6xl font-bold text-secondary-900 dark:text-white mb-6 leading-tight">
                Vende accesos a tu canal<br><span class="text-primary-600 dark:text-primary-400">sin complicaciones</span>
            </h1>
            <p class="text-lg lg:text-xl text-secondary-600 dark:text-secondary-300 mb-8 max-w-2xl mx-auto">
                Automatiza pagos, genera enlaces de invitación únicos y expulsa usuarios expirados. Todo desde un panel intuitivo.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="btn btn--primary btn--lg w-full sm:w-auto">
                    Empezar gratis
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="{{ route('channels.index') }}" class="btn btn--ghost btn--lg w-full sm:w-auto">
                    Ver canales
                </a>
            </div>
            <p class="mt-6 text-sm text-secondary-500 dark:text-secondary-400">Sin tarjeta de crédito • Setup en 5 min • Cancelar cuando quieras</p>
        </div>

        <!-- Hero Illustration -->
        <div class="mt-16 relative">
            <div class="mx-auto max-w-full h-auto bg-white dark:bg-secondary-800 rounded-2xl shadow-2xl border border-secondary-200 dark:border-secondary-700 overflow-hidden">
                <div class="aspect-video flex items-center justify-center">
                    <svg class="w-3/4 h-3/4 text-primary-200 dark:text-primary-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features py-20 bg-white dark:bg-secondary-950">
    <div class="container mx-auto px-4">
        <header class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-secondary-900 dark:text-white mb-4">Todo lo que necesitas</h2>
            <p class="text-secondary-600 dark:text-secondary-300 max-w-2xl mx-auto">Herramientas completas para creadores y plataforma segura para usuarios.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($features as $feature)
            <article class="feature-card p-6 rounded-2xl border border-secondary-200 dark:border-secondary-700 bg-white dark:bg-secondary-900 hover:border-primary-400 dark:hover:border-primary-600 hover:shadow-xl transition-all duration-300">
                <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary-700 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @switch($feature['icon'])
                            @case('shield-check')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @break
                            @case('bolt')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                @break
                            @case('users')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                @break
                            @case('chart-bar')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                @break
                            @case('currency-dollar')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @break
                            @case('document-text')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                @break
                        @endswitch
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-secondary-900 dark:text-white mb-2">{{ $feature['title'] }}</h3>
                <p class="text-secondary-600 dark:text-secondary-300">{{ $feature['description'] }}</p>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Social Proof -->
<section id="social-proof" class="social-proof py-20 bg-secondary-50 dark:bg-secondary-900">
    <div class="container mx-auto px-4">
        <header class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-secondary-900 dark:text-white mb-4">Confiado por creadores</h2>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <article class="testimonial-card p-6 rounded-2xl border border-secondary-200 dark:border-secondary-700 bg-white dark:bg-secondary-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                        <span class="text-sm font-medium text-primary-700 dark:text-primary-300">
                            {{ strtoupper($testimonial['author'][0]) }}
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-secondary-900 dark:text-white">{{ $testimonial['author'] }}</p>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
                <p class="text-secondary-600 dark:text-secondary-300 mb-4">"{{ $testimonial['content'] }}"</p>
                <div class="flex gap-1" aria-label="Rating 5 estrellas">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Pricing -->
<section id="pricing" class="pricing py-20 bg-white dark:bg-secondary-950">
    <div class="container mx-auto px-4">
        <header class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-secondary-900 dark:text-white mb-4">Precios simples y transparentes</h2>
            <p class="text-secondary-600 dark:text-secondary-300 max-w-2xl mx-auto">Sin costos ocultos. Solo pagas cuando vendes.</p>
        </header>

        <!-- Monthly/Yearly Toggle -->
        <div class="flex justify-center mb-12">
            <div class="inline-flex items-center gap-4 bg-secondary-100 dark:bg-secondary-800 rounded-lg p-1" x-data="{ yearly: false }">
                <span class="text-sm font-medium text-secondary-700 dark:text-secondary-300" :class="{ 'text-primary-600 dark:text-primary-400': !yearly }">Mensual</span>
                <button @click="yearly = !yearly" class="relative w-11 h-6 bg-secondary-200 dark:bg-secondary-700 rounded-full" :class="{ 'bg-primary-600': yearly }" aria-label="Cambiar a facturación anual">
                    <span class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200" :class="{ 'translate-x-5': yearly }"></span>
                </button>
                <span class="text-sm font-medium text-secondary-700 dark:text-secondary-300" :class="{ 'text-primary-600 dark:text-primary-400': yearly }">Anual <span class="text-xs bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 px-2 py-0.5 rounded-full ml-1">-20%</span></span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($pricingTiers as $tier)
            <article class="relative p-6 rounded-2xl border border-secondary-200 dark:border-secondary-700 bg-white dark:bg-secondary-900 flex flex-col"
                     :class="{ 'border-primary-400 dark:border-primary-600 shadow-xl': {{ $tier['popular'] ? 'true' : 'false' }} }">
                @if($tier['popular'])
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 bg-primary-600 text-white text-sm font-medium rounded-full">Más popular</div>
                @endif

                <div class="mb-6">
                    <h3 class="text-xl font-bold text-secondary-900 dark:text-white mb-2">{{ $tier['name'] }}</h3>
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl font-bold text-secondary-900 dark:text-white"
                              x-text="yearly ? '{{ number_format($tier['price_yearly'] / 12, 0, ',', '.') }}' : '{{ number_format($tier['price_monthly'], 0, ',', '.') }}'"></span>
                        <span class="text-secondary-500 dark:text-secondary-400">/mes</span>
                    </div>
                    @if($tier['price_monthly'] > 0)
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1" x-show="yearly" x-transition>
                            Facturado anualmente: ${{ number_format($tier['price_yearly'], 0, ',', '.') }}
                        </p>
                    @endif
                </div>

                <ul class="space-y-3 mb-8 flex-1">
                    @foreach($tier['features'] as $feature)
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-secondary-600 dark:text-secondary-300 text-sm">{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('register') }}" class="btn w-full {{ $tier['popular'] ? 'btn--primary' : 'btn--outline' }} btn--lg">
                    {{ $tier['cta'] }}
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="faq py-20 bg-secondary-50 dark:bg-secondary-900">
    <div class="container mx-auto px-4 max-w-3xl">
        <header class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-secondary-900 dark:text-white mb-4">Preguntas frecuentes</h2>
        </header>
        <div class="space-y-4" x-data="accordion()">
            @foreach($faqs as $index => $faq)
            <details class="group bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-lg overflow-hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer list-none" @click="toggle({{ $index }})">
                    <h3 class="text-lg font-semibold text-secondary-900 dark:text-white pr-4">{{ $faq['question'] }}</h3>
                    <svg class="w-5 h-5 text-secondary-500 dark:text-secondary-400 transition-transform duration-200 flex-shrink-0" :class="{ 'rotate-180': open === {{ $index }}}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-secondary-600 dark:text-secondary-300" x-show="open === {{ $index }}" x-transition>
                    {{ $faq['answer'] }}
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>

<!-- Footer CTA -->
<section class="cta py-20 bg-gradient-to-r from-primary-600 to-primary-700">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">¿Listo para empezar?</h2>
        <p class="text-primary-100 mb-8 max-w-2xl mx-auto">Únete a miles de creadores que ya monetizan su audiencia con TG-PayGate.</p>
        <a href="{{ route('register') }}" class="btn btn--lg bg-white text-primary-700 hover:bg-primary-50 px-8 py-3">
            Crear mi cuenta gratis
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function accordion() {
        return {
            open: null,
            toggle(index) {
                this.open = this.open === index ? null : index;
            }
        }
    }
</script>
@endpush