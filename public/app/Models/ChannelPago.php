<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;

class ChannelPago extends Model
{
    protected $table = 'channel_pagos';

    protected $fillable = [
        'owner_id', 'name', 'slug', 'description', 'category_id', 'cover_image',
        'telegram_chat_id', 'telegram_bot_token', 'telegram_bot_username', 'telegram_invite_link',
        'status', 'visibility',
        'price', 'currency', 'billing_cycle', 'trial_days',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'revenue_total' => 'decimal:2',
        'trial_days' => 'integer',
        'subscribers_count' => 'integer',
    ];

    protected $appends = ['bot_token_decrypted'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function payoutSchedules(): HasMany
    {
        return $this->hasMany(PayoutSchedule::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activePayoutSchedule()
    {
        return $this->payoutSchedules()->where('is_active', true)->latest()->first();
    }

    protected function botTokenDecrypted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->telegram_bot_token ? Crypt::decryptString($this->telegram_bot_token) : null,
        );
    }

    public function setTelegramBotTokenAttribute(string $value): void
    {
        $this->attributes['telegram_bot_token'] = Crypt::encryptString($value);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }
}
