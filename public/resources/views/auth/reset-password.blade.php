@extends('layouts.auth')

@section('title', 'Restablecer Contraseña')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Restablecer contraseña</h1>
        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Elige una nueva contraseña para tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Nueva contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
            Restablecer contraseña
        </button>
    </form>
@endsection
