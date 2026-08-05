@extends('layouts.public')

@section('title', 'Contacto')

@section('content')
<div class="container mx-auto px-4 py-16 max-w-3xl">
    <h1 class="text-3xl font-bold text-secondary-900 dark:text-white mb-6">Contacto</h1>
    <p class="text-secondary-600 dark:text-secondary-300 mb-8">¿Necesitas ayuda? Escríbenos y te responderemos a la brevedad.</p>
    <form method="POST" action="mailto:soporte@tg-paygate.com" class="space-y-5">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Nombre</label>
            <input type="text" name="name" id="name" required
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Email</label>
            <input type="email" name="email" id="email" required
                   class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
        </div>
        <div>
            <label for="message" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Mensaje</label>
            <textarea name="message" id="message" rows="4" required
                      class="mt-1 block w-full px-3 py-2 rounded-lg border border-secondary-300 dark:border-secondary-700 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
        </div>
        <button type="submit" class="py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
            Enviar mensaje
        </button>
    </form>
</div>
@endsection
