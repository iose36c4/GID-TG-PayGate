@extends('layouts.public')

@section('title', $channel->name . ' - TG-PayGate')

@section('meta_description', $channel->description ?? 'Accede al canal premium ' . $channel->name . ' en Telegram.')

@section('og_title', $channel->name . ' - TG-PayGate')

@section('og_description', $channel->description ?? 'Accede al canal premium en Telegram.')

@section('og_type', 'website')

@section('og_image', $channel->cover_image ? asset('storage/' . $channel->cover_image) : asset('images/og-default.png'))

@section('content')
<!-- Channel Hero -->
<section class="py-16 bg-gradient-to-b from-primary-50 to-white dark:from-secondary-900 dark:to-secondary-950">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <!-- Cover Image -->
                <div class="lg:col-span-1">
                    @if($channel->cover_image)
                    <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="{{ $channel->name }}"
                         class="w-full aspect-video object-cover rounded-2xl shadow-xl">
                    @else
                    <div class="w-full aspect-video bg-gradient-to-br from-primary-100 to-accent-100 dark:from-primary-900 dark:to-accent-900 rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-24 h-24 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Channel Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        @if($channel->category)
                        <span class="px-3 py-1 text-sm font-medium bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 rounded-full">
                            {{ $channel->category->name }}
                        </span>
                        @endif
                        <span class="px-3 py-1 text-sm font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">
                            Activo
                        </span>
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-bold text-secondary-900 dark:text-white mb-4">{{ $channel->name }}</h1>

                    @if($channel->description)
                    <p class="text-lg text-secondary-600 dark:text-secondary-300 mb-6">{{ $channel->description }}</p>
                    @endif

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-primary-600 dark:text-primary-400">{{ number_format($channel->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">{{ $channel->currency }}</p>
                        </div>
                        <div class="bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-secondary-900 dark:text-white capitalize">{{ $channel->billing_cycle }}</p>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Ciclo de facturación</p>
                        </div>
                        <div class="bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-xl p-4 text-center">
                            @if($channel->trial_days > 0)
                            <p class="text-2xl font-bold text-secondary-900 dark:text-white">{{ $channel->trial_days }}</p>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Días de prueba</p>
                            @else
                            <p class="text-2xl font-bold text-secondary-900 dark:text-white">—</p>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Sin prueba</p>
                            @endif
                        </div>
                    </div>

                    <!-- Benefits -->
                    <div class="space-y-3 mb-8">
                        <h3 class="text-lg font-semibold text-secondary-900 dark:text-white">Qué incluye tu suscripción</h3>
                        <ul class="space-y-2">
                            @foreach([
                                'Acceso completo al canal/grupo privado de Telegram',
                                'Contenido exclusivo solo para suscriptores',
                                'Enlace de invitación único y personal',
                                'Soporte prioritario del creador',
                                'Cancelación en cualquier momento',
                            ] as $benefit)
                            <li class="flex items-center gap-3 text-secondary-600 dark:text-secondary-300">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $benefit }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('checkout.create', $channel) }}" class="btn btn--primary btn--lg w-full sm:w-auto text-center">
                        Suscribirme por {{ number_format($channel->price, 0, ',', '.') }} {{ $channel->currency }}/{{ $channel->billing_cycle }}
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trust Signals -->
<section class="py-12 bg-white dark:bg-secondary-950">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-8 h-8 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Pago seguro</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">MercadoPago, Stripe, PayPal</p>
                </div>
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-8 h-8 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Acceso instantáneo</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Enlace único tras el pago</p>
                </div>
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-8 h-8 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Privacidad</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Datos protegidos</p>
                </div>
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-8 h-8 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Soporte</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Equipo dedicado</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Creator Info -->
@if($channel->owner)
<section class="py-12 bg-secondary-50 dark:bg-secondary-900">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                        <span class="text-2xl font-bold text-primary-700 dark:text-primary-300">
                            {{ strtoupper($channel->owner->name[0]) }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-secondary-900 dark:text-white">{{ $channel->owner->name }}</h3>
                        <p class="text-secondary-600 dark:text-secondary-300">Creador del canal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection