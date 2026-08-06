<?php

namespace App\Domains\Public\Services\Gateways;

use App\Domains\Public\Contracts\PaymentGatewayInterface;

class StripeGateway implements PaymentGatewayInterface
{
    public function __construct(
        protected string $secretKey,
        protected string $publishableKey,
        protected string $webhookSecret
    ) {
    }

    public function createCheckout(array $data): array
    {
        return [
            'url' => 'https://checkout.stripe.com/pay/example',
            'session_id' => 'cs_example',
            'external_reference' => $data['external_reference'] ?? null,
        ];
    }

    public function verifyPayment(string $reference): array
    {
        return [
            'status' => 'paid',
            'amount' => 1000.00,
            'payment_id' => 'pi_example',
        ];
    }

    public function refundPayment(string $paymentId, float $amount = null): array
    {
        return ['status' => 'refunded', 'refund_id' => 're_example'];
    }

    public function getSupportedCurrencies(): array
    {
        return ['USD', 'EUR', 'GBP'];
    }

    public function getGatewayName(): string
    {
        return 'stripe';
    }
}