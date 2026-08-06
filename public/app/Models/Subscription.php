<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'channel_pago_id', 'external_reference',
        'price', 'currency', 'billing_cycle',
        'status', 'trial_ends_at', 'starts_at', 'renews_at',
        'activated_at', 'telegram_invite_link', 'invite_expires_at',
        'cancelled_at', 'cancelled_by', 'cancellation_reason',
        'auto_renew', 'failed_payments',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'trial_ends_at' => 'datetime',
        'starts_at' => 'datetime',
        'renews_at' => 'datetime',
        'activated_at' => 'datetime',
        'invite_expires_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'auto_renew' => 'boolean',
        'failed_payments' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(ChannelPago::class, 'channel_pago_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->isActive() ? 'active' : $value,
        );
    }

    public function isActive(): bool
    {
        if ($this->status === 'active' && $this->renews_at && $this->renews_at->isPast()) {
            return false;
        }

        return $this->status === 'active';
    }

    public function isTrial(): bool
    {
        return $this->status === 'trial' && $this->trial_ends_at && $this->trial_ends_at->isFuture();
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired' || ($this->renews_at && $this->renews_at->isPast() && ! $this->auto_renew);
    }

    public function cancel(string $reason, int $byUserId): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => $byUserId,
            'cancellation_reason' => $reason,
        ]);
    }

    public function renew(): void
    {
        $nextRenewal = match ($this->billing_cycle) {
            'monthly' => now()->addMonth(),
            'quarterly' => now()->addMonths(3),
            'yearly' => now()->addYear(),
            'lifetime' => now()->addYears(100),
        };

        $this->update([
            'status' => 'active',
            'cancelled_at' => null,
            'cancelled_by' => null,
            'cancellation_reason' => null,
            'renews_at' => $nextRenewal,
            'failed_payments' => 0,
        ]);
    }

    public function activate(): void
    {
        $nextRenewal = match ($this->billing_cycle) {
            'monthly' => now()->addMonth(),
            'quarterly' => now()->addMonths(3),
            'yearly' => now()->addYear(),
            'lifetime' => now()->addYears(100),
        };

        $this->update([
            'status' => 'active',
            'activated_at' => now(),
            'starts_at' => $this->starts_at ?? now(),
            'renews_at' => $nextRenewal,
            'failed_payments' => 0,
        ]);
    }

    public function storeInviteLink(string $link, ?\Illuminate\Support\Carbon $expiresAt = null): void
    {
        $this->update([
            'telegram_invite_link' => $link,
            'invite_expires_at' => $expiresAt ?? now()->addHours(24),
        ]);
    }

    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'active' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            'cancelled' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
            'expired' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            'trial' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
        };
    }
}
