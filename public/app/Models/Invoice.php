<?php

namespace App\Models;

use App\Domains\Financiero\Entities\InvoiceState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

class Invoice extends Model
{
    protected $fillable = [
        'payment_id', 'subscription_id', 'user_id', 'channel_pago_id',
        'invoice_number', 'status', 'issuer_data', 'receiver_data', 'items',
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

    public function state(): InvoiceState
    {
        return InvoiceState::from($this->status);
    }

    public function transitionTo(InvoiceState $to): void
    {
        $from = $this->state();

        if (! $from->canTransitionTo($to)) {
            throw new LogicException(
                sprintf('Invalid invoice state transition: %s → %s', $from->value, $to->value),
            );
        }

        $this->update(['status' => $to->value]);
    }

    public function isAuthorized(): bool
    {
        return $this->afip_status === 'authorized';
    }

    public function isPending(): bool
    {
        return $this->afip_status === 'pending';
    }

    public function isPaid(): bool
    {
        return $this->state()->isPaid();
    }
}
