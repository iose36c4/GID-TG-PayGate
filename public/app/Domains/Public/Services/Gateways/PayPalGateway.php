<?php

namespace App\Domains\Public\Services\Gateways;

use App\Domains\Public\Contracts\PaymentGatewayInterface;

class PayPalGateway implements PaymentGatewayInterface
{
    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected string $mode = 'sandbox'
    ) {
    }

    public function createCheckout(array $data): array
    {
        return [
            'url' => 'https://www.paypal.com/checkout',
            'session_id' => 'checkout_example',
            'external_reference' => $data['external_reference'] ?? null,
        ];
    }

    public function verifyPayment(string $reference): array
    {
        return [
            'status' => 'COMPLETED',
            'amount' => 1000.00,
            'payment_id' => 'PAY-123',
            'payment_method' => 'paypal',
            'installments' => 1,
        ];
    }

    public function refundPayment(string $paymentId, float $amount = null): array
    {
        return ['status' => 'REFUNDED', 'refund_id' => 'REF-456'];
    }

    public function getSupportedCurrencies(): array
    {
        return ['USD', 'EUR', 'GBP', 'CAD', 'AUD'];
    }

    public function getGatewayName(): string
    {
        return 'paypal';
    }
}