@extends('layouts.auth')

@section('title', 'Registro')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Crear cuenta</h1>
        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Únete a TG-PayGate</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>

        <div>
            <span class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-2">¿Qué cuenta quieres crear?</span>
            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer">
                    <input type="radio" name="role" value="user" class="sr-only peer" checked>
                    <div class="p-3 rounded-lg border border-secondary-300 dark:border-secondary-700 peer-checked:border-primary-500 peer-checked:ring-2 peer-checked:ring-primary-500/30 transition-colors">
                        <p class="text-sm font-medium text-secondary-900 dark:text-white">Comprador</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-0.5">Comprar accesos a canales</p>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="role" value="creador" class="sr-only peer">
                    <div class="p-3 rounded-lg border border-secondary-300 dark:border-secondary-700 peer-checked:border-primary-500 peer-checked:ring-2 peer-checked:ring-primary-500/30 transition-colors">
                        <p class="text-sm font-medium text-secondary-900 dark:text-white">Creador</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-0.5">Vender accesos a tu canal</p>
                    </div>
                </label>
            </div>
            @error('role')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
            Crear cuenta
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-secondary-500 dark:text-secondary-400">
        ¿Ya tienes cuenta?
        <a href="{{ route('login') }}" class="text-primary-600 dark:text-primary-400 hover:underline font-medium">Inicia sesión</a>
    </p>
@endsection
