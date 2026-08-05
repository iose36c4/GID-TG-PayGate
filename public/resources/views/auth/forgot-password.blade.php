@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Recuperar contraseña</h1>
        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Te enviaremos un enlace para restablecerla</p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-lg text-sm text-primary-700 dark:text-primary-300">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
            Enviar enlace de recuperación
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-secondary-500 dark:text-secondary-400">
        <a href="{{ route('login') }}" class="text-primary-600 dark:text-primary-400 hover:underline font-medium">&larr; Volver a iniciar sesión</a>
    </p>
@endsection
