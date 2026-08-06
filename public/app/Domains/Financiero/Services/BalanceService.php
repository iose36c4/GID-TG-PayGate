<?php

namespace App\Domains\Financiero\Services;

use App\Domains\Financiero\ValueObjects\Money;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class BalanceService
{
    public function balanceOf(string $accountCode, string $currency = 'ARS'): Money
    {
        $net = DB::table('ledger_entries')
            ->join('accounts', 'ledger_entries.account_id', '=', 'accounts.id')
            ->where('accounts.code', $accountCode)
            ->where('ledger_entries.currency', $currency)
            ->selectRaw('COALESCE(SUM(CASE WHEN ledger_entries.debit THEN ledger_entries.amount_cents ELSE -ledger_entries.amount_cents END), 0) AS net')
            ->value('net');

        return Money::fromCents((int) $net, $currency);
    }

    public function balanceAt(string $accountCode, string $currency, Carbon $until): Money
    {
        $net = DB::table('ledger_entries')
            ->join('accounts', 'ledger_entries.account_id', '=', 'accounts.id')
            ->where('accounts.code', $accountCode)
            ->where('ledger_entries.currency', $currency)
            ->where('ledger_entries.created_at', '<=', $until)
            ->selectRaw('COALESCE(SUM(CASE WHEN ledger_entries.debit THEN ledger_entries.amount_cents ELSE -ledger_entries.amount_cents END), 0) AS net')
            ->value('net');

        return Money::fromCents((int) $net, $currency);
    }

    public function isBalanced(): bool
    {
        $total = DB::table('ledger_entries')
            ->selectRaw('SUM(CASE WHEN debit THEN amount_cents ELSE -amount_cents END) AS net')
            ->value('net');

        return (int) $total === 0;
    }
}
