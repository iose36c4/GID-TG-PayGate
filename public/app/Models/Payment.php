<?php

namespace App\Models;

use App\Domains\Financiero\Entities\PaymentState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use LogicException;

class Payment extends Model
{
    protected $fillable = [
        'subscription_id', 'user_id', 'channel_pago_id', 'external_reference',
        'amount', 'net_amount', 'currency',
        'platform_fee', 'gateway_fee', 'fixed_fee',
        'gateway', 'gateway_payment_id', 'gateway_status',
        'status', 'paid_at', 'failed_at', 'failure_reason',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'gateway_fee' => 'decimal:2',
        'fixed_fee' => 'decimal:2',
        'paid_at' => 'datetime',
        'failed_at' => 'datetime',
        'metadata' => 'array',
    ];

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

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function state(): PaymentState
    {
        return PaymentState::from($this->status);
    }

    public function transitionTo(PaymentState $to): void
    {
        $from = $this->state();

        if (! $from->canTransitionTo($to)) {
            throw new LogicException(
                sprintf('Invalid payment state transition: %s → %s', $from->value, $to->value),
            );
        }

        $attributes = ['status' => $to->value];

        if ($to->isPaid()) {
            $attributes['paid_at'] = now();
        }

        $this->update($attributes);
    }

    public function isCompleted(): bool
    {
        return $this->state()->isPaid();
    }

    public function isPending(): bool
    {
        return in_array($this->state(), [
            PaymentState::Created,
            PaymentState::PendingConfirmation,
            PaymentState::WaitingConfirmation,
        ], true);
    }

    public function isFailed(): bool
    {
        return $this->state() === PaymentState::Failed;
    }

    public function markCompleted(): void
    {
        $this->transitionTo(PaymentState::Paid);
    }

    public function markFailed(string $reason): void
    {
        $this->update([
            'status' => PaymentState::Failed->value,
            'failed_at' => now(),
            'failure_reason' => $reason,
        ]);
    }

    public function markExpired(): void
    {
        $this->transitionTo(PaymentState::Expired);
    }

    public function refund(): void
    {
        $this->transitionTo(PaymentState::Refunded);
    }
}
