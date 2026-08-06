@extends('layouts.public')

@section('title', 'Checkout - ' . $channel->name . ' - TG-PayGate')

@section('meta_description', 'Completa tu suscripción a ' . $channel->name . ' y accede al canal premium de Telegram.')

@section('og_title', 'Checkout - ' . $channel->name . ' - TG-PayGate')

@section('og_description', 'Completa tu suscripción y accede al canal premium de Telegram.')

@section('content')
<!-- Checkout Hero -->
<section class="py-16 bg-gradient-to-b from-primary-50 to-white dark:from-secondary-900 dark:to-secondary-950">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-3xl lg:text-4xl font-bold text-secondary-900 dark:text-white mb-4">Completa tu suscripción</h1>
            <p class="text-lg text-secondary-600 dark:text-secondary-300 mb-8">Accede a <strong>{{ $channel->name }}</strong> en Telegram</p>

            <div class="bg-white dark:bg-secondary-800 border border-secondary-200 dark:border-secondary-700 rounded-2xl p-6 max-w-md mx-auto">
                <div class="flex items-center gap-4 mb-4">
                    @if($channel->cover_image)
                    <img src="{{ asset('storage/' . $channel->cover_image) }}" alt="{{ $channel->name }}"
                         class="w-16 h-16 object-cover rounded-lg">
                    @else
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-accent-100 dark:from-primary-900 dark:to-accent-900 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-bold text-secondary-900 dark:text-white">{{ $channel->name }}</h2>
                        <p class="text-secondary-600 dark:text-secondary-300">{{ $channel->billing_cycle }} • {{ number_format($channel->price, 0, ',', '.') }} {{ $channel->currency }}</p>
                    </div>
                </div>

                <div class="text-center">
                    @if($channel->trial_days > 0)
                    <span class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-sm font-medium rounded-full mb-4">
                        {{ $channel->trial_days }} días de prueba gratis
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Form -->
<section class="py-12 bg-white dark:bg-secondary-950">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-secondary-900 dark:text-white mb-6">Información de pago</h2>

                <form method="POST" action="{{ route('checkout.store', $channel) }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" required
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-secondary-300 dark:border-secondary-600 rounded-lg bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500"
                               placeholder="tu@email.com">
                    </div>

                    <!-- Payment Gateway Selection -->
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-3">
                            Método de pago <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach(['mercadopago' => 'MercadoPago', 'stripe' => 'Stripe', 'paypal' => 'PayPal'] as $key => $name)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="gateway" value="{{ $key }}" required
                                       class="sr-only peer"
                                       {{ old('gateway') == $key ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-secondary-200 dark:border-secondary-700 rounded-lg text-center transition-all
                                    peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20">
                                    <span class="font-medium text-secondary-900 dark:text-white">{{ $name }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="terms" id="terms" required
                               class="mt-1 w-4 h-4 text-primary-600 border-secondary-300 rounded focus:ring-primary-500">
                        <label for="terms" class="text-sm text-secondary-600 dark:text-secondary-300">
                            Acepto los <a href="{{ route('terms') }}" class="text-primary-600 hover:underline">Términos y Condiciones</a> y la <a href="{{ route('privacy') }}" class="text-primary-600 hover:underline">Política de Privacidad</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full btn btn--primary btn--lg py-4">
                        Pagar {{ number_format($channel->price, 0, ',', '.') }} {{ $channel->currency }}
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    <p class="text-center text-xs text-secondary-500 dark:text-secondary-400">
                        Procesado de forma segura por la pasarela seleccionada. No almacenamos datos de tarjetas.
                    </p>
                </form>
            </div>

            <!-- Trust Signals -->
            <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-6 h-6 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Pago seguro</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">SSL 256-bit</p>
                </div>
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-6 h-6 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Acceso instantáneo</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Enlace único</p>
                </div>
                <div class="p-4 bg-secondary-50 dark:bg-secondary-800 rounded-xl">
                    <svg class="w-6 h-6 mx-auto text-primary-600 dark:text-primary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <p class="text-sm font-medium text-secondary-900 dark:text-white">Cancelarいつでも</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Sin compromiso</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection