<?php

namespace App\Domains\Public\Routes;

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::post('/webhooks/mercadopago/{channel}', '\App\Http\Controllers\Webhook\MercadoPagoWebhookController')->name('webhooks.mercadopago');
    Route::post('/webhooks/stripe', '\App\Http\Controllers\Webhook\StripeWebhookController')->name('webhooks.stripe');
    Route::post('/webhooks/paypal', '\App\Http\Controllers\Webhook\PayPalWebhookController')->name('webhooks.paypal');
});