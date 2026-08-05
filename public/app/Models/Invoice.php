<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'payment_id', 'subscription_id', 'user_id', 'channel_pago_id',
        'invoice_number', 'issuer_data', 'receiver_data', 'items',
        'subtotal', 'tax_amount', 'total', 'currency',
        'afip_status', 'cae', 'cae_expires_at', 'afip_qr', 'pdf_path',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'issuer_data' => 'array',
        'receiver_data' => 'array',
        'items' => 'array',
        'cae_expires_at' => 'datetime',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(ChannelPago::class, 'channel_pago_id');
    }

    public function isAuthorized(): bool
    {
        return $this->afip_status === 'authorized';
    }

    public function isPending(): bool
    {
        return $this->afip_status === 'pending';
    }
}
