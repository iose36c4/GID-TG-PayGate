<?php

namespace App\Http\Controllers\Webhook;

use App\Models\Subscription;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class PayPalWebhookController
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        $eventType = $payload['event_type'] ?? '';

        if ($eventType === 'PAYMENT.SOLVED') {
            $paymentId = $payload['resource']['id'];
            $this->processPayment($paymentId, $request);
        }

        return response()->json(['status' => 'ok']);
    }

    private function processPayment(string $paymentId, Request $request): void
    {
        $subscription = Subscription::where('external_reference', $paymentId)->first();

        if ($subscription) {
            $subscription->update([
                'status' => 'active',
                'activated_at' => now(),
                'renews_at' => now()->addMonth(),
                'paypal_payment_id' => $paymentId,
            ]);

            $channel = $subscription->channel;
            if ($channel) {
                $inviteLink = app(\App\Services\TelegramService::class)->createChatInviteLink(
                    decrypt($channel->telegram_bot_token),
                    $channel->telegram_chat_id,
                    ['member_limit' => 1, 'expires_at' => now()->addDays(1)]
                );

                if (!empty($inviteLink['invite_link'])) {
                    $subscription->storeInviteLink($inviteLink['invite_link']);
                }
            }
        }
    }
}