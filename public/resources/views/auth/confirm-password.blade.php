@extends('layouts.auth')

@section('title', 'Confirmar Contraseña')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Confirma tu contraseña</h1>
        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Por seguridad, confirma tu contraseña para continuar.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="current-password" autofocus
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
            Confirmar
        </button>
    </form>
@endsection
