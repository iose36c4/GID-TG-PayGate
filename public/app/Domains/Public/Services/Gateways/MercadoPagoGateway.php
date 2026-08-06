<?php

namespace App\Domains\Public\Services\Gateways;

use App\Domains\Public\Contracts\PaymentGatewayInterface;

class MercadoPagoGateway implements PaymentGatewayInterface
{
    public function __construct(
        protected string $accessToken,
        protected string $publicKey,
        protected string $mode = 'sandbox'
    ) {
    }

    public function createCheckout(array $data): array
    {
        return [
            'url' => 'https://www.mercadopago.com.ar/checkout',
            'session_id' => 'pref_example',
            'external_reference' => $data['external_reference'] ?? null,
        ];
    }

    public function verifyPayment(string $reference): array
    {
        return [
            'status' => 'approved',
            'amount' => 1000.00,
            'payment_id' => 'pay_example',
            'payment_method' => 'credit_card',
            'installments' => 1,
        ];
    }

    public function refundPayment(string $paymentId, float $amount = null): array
    {
        return ['status' => 'refunded', 'refund_id' => 'ref_example'];
    }

    public function getSupportedCurrencies(): array
    {
        return ['ARS', 'USD', 'BRL', 'MXN', 'COP', 'PEN', 'CLP', 'UYU'];
    }

    public function getGatewayName(): string
    {
        return 'mercadopago';
    }
}