@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detalle de Suscripción</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $subscription->user->name }} • {{ $subscription->channel->name }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('creador.subscriptions.index') }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-2 px-4 rounded-lg transition-colors">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Información de la Suscripción</h2>
                <dl class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Suscriptor</dt>
                            <dd class="text-gray-900 dark:text-white font-medium">{{ $subscription->user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Canal</dt>
                            <dd class="text-gray-900 dark:text-white">
                                <a href="{{ route('creador.channels.show', $subscription->channel) }}" class="text-primary-600 hover:underline">
                                    {{ $subscription->channel->name }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Estado</dt>
                            <dd>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $subscription->getStatusBadgeClass() }}">
                                    {{ ucfirst($subscription->status) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Precio</dt>
                            <dd class="text-gray-900 dark:text-white font-medium">{{ $subscription->currency }} {{ number_format($subscription->price, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Ciclo de facturación</dt>
                            <dd class="text-gray-900 dark:text-white capitalize">{{ $subscription->billing_cycle }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Fecha de inicio</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->starts_at?->format('d/m/Y H:i') ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Próxima renovación</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->renews_at?->format('d/m/Y H:i') ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Fin de prueba</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->trial_ends_at?->format('d/m/Y H:i') ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Auto-renovación</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->auto_renew ? 'Sí' : 'No' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Pagos fallidos</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->failed_payments }}</dd>
                        </div>
                        @if($subscription->cancelled_at)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Cancelada el</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->cancelled_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Cancelada por</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->cancelledBy?->name ?? 'Sistema' }}</dd>
                        </div>
                        <div class="col-span-2">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Razón de cancelación</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $subscription->cancellation_reason }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Historial de Pagos</h2>
                @if($subscription->payments->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No hay pagos registrados</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="p-3 text-left text-sm font-semibold text-gray-500 dark:text-gray-400">Fecha</th>
                                <th class="p-3 text-right text-sm font-semibold text-gray-500 dark:text-gray-400">Monto</th>
                                <th class="p-3 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Estado</th>
                                <th class="p-3 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Pasarela</th>
                                <th class="p-3 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">ID Transacción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($subscription->payments->sortByDesc('created_at') as $payment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="p-3 text-sm text-gray-900 dark:text-white">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3 text-right text-sm font-medium text-gray-900 dark:text-white">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                                <td class="p-3 text-center">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'processing' => 'bg-blue-100 text-blue-700',
                                            'completed' => 'bg-green-100 text-green-700',
                                            'failed' => 'bg-red-100 text-red-700',
                                            'refunded' => 'bg-purple-100 text-purple-700',
                                            'cancelled' => 'bg-gray-100 text-gray-700',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$payment->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td class="p-3 text-center text-sm text-gray-500 dark:text-gray-400">{{ $payment->gateway }}</td>
                                <td class="p-3 text-center text-sm text-gray-500 dark:text-gray-400 font-mono">{{ $payment->gateway_payment_id ?: '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Facturas</h2>
                @if($subscription->invoices->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No hay facturas generadas</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="p-3 text-left text-sm font-semibold text-gray-500 dark:text-gray-400">Número</th>
                                <th class="p-3 text-right text-sm font-semibold text-gray-500 dark:text-gray-400">Total</th>
                                <th class="p-3 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Estado AFIP</th>
                                <th class="p-3 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Fecha</th>
                                <th class="p-3 text-center text-sm font-semibold text-gray-500 dark:text-gray-400">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($subscription->invoices->sortByDesc('created_at') as $invoice)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="p-3 text-sm font-mono text-gray-900 dark:text-white">{{ $invoice->invoice_number }}</td>
                                <td class="p-3 text-right text-sm font-medium text-gray-900 dark:text-white">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</td>
                                <td class="p-3 text-center">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'authorized' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            'cancelled' => 'bg-gray-100 text-gray-700',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$invoice->afip_status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($invoice->afip_status) }}
                                    </span>
                                </td>
                                <td class="p-3 text-center text-sm text-gray-500 dark:text-gray-400">{{ $invoice->created_at->format('d/m/Y') }}</td>
                                <td class="p-3 text-center">
                                    @if($invoice->pdf_path)
                                    <a href="{{ asset('storage/' . $invoice->pdf_path) }}" target="_blank" class="text-primary-600 hover:text-primary-700 text-sm">Ver PDF</a>
                                    @else
                                    <span class="text-gray-400 text-sm">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Acciones</h2>
                <div class="space-y-3">
                    @if($subscription->status === 'active')
                    <form action="{{ route('creador.subscriptions.cancel', $subscription) }}" method="POST" class="w-full" onsubmit="return confirm('¿Estás seguro de cancelar esta suscripción? El usuario perderá acceso al canal.')">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Razón de cancelación</label>
                            <textarea name="reason" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required placeholder="Motivo de la cancelación..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Cancelar Suscripción
                        </button>
                    </form>
                    @elseif($subscription->status === 'cancelled' || $subscription->status === 'expired')
                    <form action="{{ route('creador.subscriptions.renew', $subscription) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Renovar Suscripción
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Resumen Financiero</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-600 dark:text-gray-400">Total pagado</dt>
                        <dd class="text-gray-900 dark:text-white font-medium">{{ $subscription->currency }} {{ number_format($subscription->payments->where('status', 'completed')->sum('amount'), 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600 dark:text-gray-400">Pendiente</dt>
                        <dd class="text-gray-900 dark:text-white font-medium">{{ $subscription->currency }} {{ number_format($subscription->payments->where('status', 'pending')->sum('amount'), 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600 dark:text-gray-400">Fallidos</dt>
                        <dd class="text-gray-900 dark:text-white font-medium">{{ $subscription->currency }} {{ number_format($subscription->payments->where('status', 'failed')->sum('amount'), 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600 dark:text-gray-400">Reembolsados</dt>
                        <dd class="text-gray-900 dark:text-white font-medium">{{ $subscription->currency }} {{ number_format($subscription->payments->where('status', 'refunded')->sum('amount'), 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection