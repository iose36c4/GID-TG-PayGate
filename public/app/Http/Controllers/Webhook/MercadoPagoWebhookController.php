<?php

namespace App\Http\Controllers\Webhook;

use App\Models\ChannelPago;
use App\Models\Subscription;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MercadoPagoWebhookController
{
    public function handle(Request $request, ChannelPago $channel)
    {
        $this->validateSignature($request, $channel);

        $payload = $request->all();
        $topic = $payload['topic'] ?? '';

        if ($topic === 'payment') {
            $paymentId = $payload['data']['id'];
            $this->processPayment($paymentId, $channel);
        }

        return response()->json(['status' => 'ok']);
    }

    private function validateSignature(Request $request, ChannelPago $channel): void
    {
        $signature = $request->header('x-signature');
        $requestId = $request->header('x-request-id');

        if ($signature && $channel->mercadopago_client_secret) {
            $expected = hash_hmac('sha256', $requestId . '|' . $request->getContent(),
                decrypt($channel->mercadopago_client_secret));

            if (!hash_equals($expected, $signature)) {
                abort(401, 'Firma inválida');
            }
        }
    }

    private function processPayment(string $paymentId, ChannelPago $channel): void
    {
        $payment = ['status' => 'approved', 'id' => $paymentId, 'external_reference' => $paymentId];

        $subscription = Subscription::where('external_reference', $payment['external_reference'])->first();

        if ($subscription && $payment['status'] === 'approved') {
            $subscription->update([
                'status' => 'active',
                'activated_at' => now(),
                'renews_at' => now()->addMonth(),
                'mercadopago_payment_id' => $payment['id'],
            ]);

            app(TelegramService::class)->sendInviteLink($subscription);
        }
    }
}