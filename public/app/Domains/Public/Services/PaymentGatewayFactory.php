<?php

namespace App\Domains\Public\Services\Gateways;

use App\Domains\Public\Contracts\PaymentGatewayInterface;

class PaymentGatewayFactory
{
    public static function create(string $gateway, array $config): PaymentGatewayInterface
    {
        return match($gateway) {
            'mercadopago' => new MercadoPagoGateway(
                $config['access_token'],
                $config['public_key'],
                $config['mode'] ?? 'sandbox'
            ),
            'stripe' => new StripeGateway(
                $config['secret_key'],
                $config['publishable_key'],
                $config['webhook_secret']
            ),
            'paypal' => new PayPalGateway(
                $config['client_id'],
                $config['client_secret'],
                $config['mode'] ?? 'sandbox'
            ),
            default => throw new \InvalidArgumentException("Gateway no soportado: $gateway"),
        };
    }
}