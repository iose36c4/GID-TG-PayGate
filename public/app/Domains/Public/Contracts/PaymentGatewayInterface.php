<?php

namespace App\Domains\Public\Contracts;

interface PaymentGatewayInterface
{
    public function createCheckout(array $data): array;
    public function verifyPayment(string $reference): array;
    public function refundPayment(string $paymentId, float $amount = null): array;
    public function getSupportedCurrencies(): array;
    public function getGatewayName(): string;
}