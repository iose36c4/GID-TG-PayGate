<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

class LedgerEntry extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'entry_group', 'account_id', 'amount_cents', 'debit', 'currency',
        'reference_id', 'reference_type', 'description',
    ];

    protected $casts = [
        'amount_cents' => 'integer',
        'debit' => 'boolean',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function update(array $attributes = [], array $options = []): bool
    {
        throw new LogicException('Ledger entries are immutable and cannot be updated.');
    }

    public function delete(): ?bool
    {
        throw new LogicException('Ledger entries are immutable and cannot be deleted.');
    }
}
