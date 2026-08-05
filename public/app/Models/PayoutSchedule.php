<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayoutSchedule extends Model
{
    protected $fillable = [
        'channel_pago_id', 'frequency', 'minimum_amount',
        'platform_fee_percentage', 'gateway_fee_percentage', 'fixed_fee',
        'next_payout_at', 'is_active',
    ];

    protected $casts = [
        'minimum_amount' => 'decimal:2',
        'platform_fee_percentage' => 'decimal:4',
        'gateway_fee_percentage' => 'decimal:4',
        'fixed_fee' => 'decimal:2',
        'next_payout_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(ChannelPago::class);
    }
}
