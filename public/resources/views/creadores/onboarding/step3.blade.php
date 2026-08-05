@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Paso 3 de 4</p>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bot de Telegram</h1>
            </div>
        </div>

        <form action="{{ route('creador.onboarding.step3.store', $channel) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            @if($channel->telegram_bot_username)
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-green-800 dark:text-green-200">Bot ya configurado</p>
                        <p class="text-sm text-green-700 dark:text-green-300">@{{ $channel->telegram_bot_username }} está vinculado correctamente.</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Configuración del Bot</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Token del Bot</label>
                        <input type="password" name="telegram_bot_token" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ" required autocomplete="new-password">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Obtén tu token en @BotFather. Se cifra con AES-256 en la base de datos.</p>
                        @error('telegram_bot_token')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Chat ID del Grupo/Canal (opcional)</label>
                        <input type="number" name="telegram_chat_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="-1001234567890" value="{{ $channel->telegram_chat_id ?? '' }}">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">ID del grupo/canal donde el bot gestionará suscripciones. Formato: -100xxxxxxxxxx</p>
                        @error('telegram_chat_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Cómo configurar tu bot:</h4>
                    <ol class="text-sm text-gray-600 dark:text-gray-400 space-y-2 list-decimal list-inside">
                        <li>Habla con <a href="https://t.me/BotFather" target="_blank" class="text-primary-600 hover:underline">@BotFather</a> en Telegram</li>
                        <li>Envía <code class="bg-gray-200 dark:bg-gray-700 px-1.5 py-0.5 rounded text-xs font-mono">/newbot</code> y sigue las instrucciones</li>
                        <li>Copia el token que te proporciona (formato: <code class="bg-gray-200 dark:bg-gray-700 px-1.5 py-0.5 rounded text-xs font-mono">123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ</code>)</li>
                        <li>Añade el bot a tu grupo/canal como administrador</li>
                        <li>Para obtener el Chat ID, reenvía un mensaje del grupo a <a href="https://t.me/userinfobot" target="_blank" class="text-primary-600 hover:underline">@userinfobot</a></li>
                    </ol>
                </div>
            </div>

            <div class="flex justify-between gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('creador.onboarding.step2') }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver
                </a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2 ms-auto">
                    Validar y Continuar
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection