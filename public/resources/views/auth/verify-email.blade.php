@extends('layouts.auth')

@section('title', 'Verificar Email')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Verifica tu email</h1>
        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Necesitamos confirmar tu dirección de correo antes de continuar.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-lg text-sm text-primary-700 dark:text-primary-300">
            Un nuevo enlace de verificación ha sido enviado a tu email.
        </div>
    @endif

    <p class="text-sm text-secondary-600 dark:text-secondary-300 mb-6">
        Revisa tu bandeja de entrada y haz clic en el enlace de verificación. Si no recibiste el correo, puedes solicitar otro.
    </p>

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
        @csrf
        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
            Reenviar enlace de verificación
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit"
                class="w-full py-2.5 px-4 border border-secondary-300 dark:border-secondary-700 text-secondary-700 dark:text-secondary-300 font-medium rounded-lg hover:bg-secondary-50 dark:hover:bg-secondary-800 transition-colors">
            Cerrar sesión
        </button>
    </form>
@endsection
