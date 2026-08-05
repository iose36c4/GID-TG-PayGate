@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Mi Perfil</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Gestiona tus datos personales y contraseña</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-sm text-green-700 dark:text-green-300">
            Tu perfil ha sido actualizado correctamente.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-sm text-green-700 dark:text-green-300">
            Tu contraseña ha sido actualizada correctamente.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Datos de la cuenta</h2>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required autocomplete="name"
                           class="mt-1 block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                    @error('name', 'default')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required autocomplete="username"
                           class="mt-1 block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                    @if (auth()->user()->email_verified_at)
                        <p class="mt-1 text-xs text-green-600 dark:text-green-400">Email verificado</p>
                    @else
                        <p class="mt-1 text-xs text-amber-600 dark:text-amber-400">Email sin verificar</p>
                    @endif
                    @error('email', 'default')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="timezone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Zona horaria</label>
                    <select name="timezone" id="timezone"
                            class="mt-1 block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @foreach (timezone_identifiers_list() as $tz)
                            <option value="{{ $tz }}" @selected(old('timezone', auth()->user()->timezone ?? 'UTC') === $tz)>{{ $tz }}</option>
                        @endforeach
                    </select>
                    @error('timezone', 'default')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                    Guardar cambios
                </button>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Cambiar contraseña</h2>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña actual</label>
                    <input type="password" name="current_password" id="current_password" required autocomplete="current-password"
                           class="mt-1 block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                    @error('current_password', 'updatePassword')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nueva contraseña</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password"
                           class="mt-1 block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                    @error('password', 'updatePassword')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                           class="mt-1 block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>

                <button type="submit"
                        class="py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                    Actualizar contraseña
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
