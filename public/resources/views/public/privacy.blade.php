@extends('layouts.public')

@section('title', 'Política de Privacidad')

@section('content')
<div class="container mx-auto px-4 py-16 max-w-3xl">
    <h1 class="text-3xl font-bold text-secondary-900 dark:text-white mb-6">Política de Privacidad</h1>
    <div class="space-y-4 text-secondary-600 dark:text-secondary-300 text-sm leading-relaxed">
        <h2 class="text-lg font-semibold text-secondary-900 dark:text-white">1. Datos que recopilamos</h2>
        <p>Recopilamos los datos necesarios para operar el servicio: nombre, email, datos fiscales de creadores y registros de pago. No almacenamos datos de tarjetas (cumplimiento PCI vía webhooks).</p>
        <h2 class="text-lg font-semibold text-secondary-900 dark:text-white">2. Uso de la información</h2>
        <p>Utilizamos tus datos para gestionar pagos, emitir facturas, entregar accesos y brindar soporte.</p>
        <h2 class="text-lg font-semibold text-secondary-900 dark:text-white">3. Tokens de Telegram</h2>
        <p>Los tokens de bot se almacenan cifrados con cifrado AES-256 y solo se usan para automatizar invitaciones.</p>
        <p class="text-xs text-secondary-400">Última actualización: 2026-08-05</p>
    </div>
</div>
@endsection
