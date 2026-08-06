<?php

namespace App\Domains\Financiero\Services;

use App\Domains\Financiero\Exceptions\LedgerEntryAlreadyPosted;
use App\Domains\Financiero\Exceptions\LedgerOutOfBalance;
use App\Domains\Financiero\ValueObjects\Money;
use App\Models\Account;
use App\Models\LedgerEntry;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final class LedgerService
{
    /**
     * Posts a balanced set of double-entry ledger lines.
     *
     * @param  array<int, array{account_code: string, amount: Money, debit: bool}>  $entries
     */
    public function post(
        string $entryGroup,
        string $referenceId,
        ?string $referenceType,
        string $description,
        array $entries,
    ): void {
        if ($entries === []) {
            throw new InvalidArgumentException('Ledger post requires at least one entry.');
        }

        if (LedgerEntry::query()->where('entry_group', $entryGroup)->exists()) {
            throw new LedgerEntryAlreadyPosted("Ledger entry group already posted: {$entryGroup}");
        }

        $this->assertBalanced($entries);

        $accounts = $this->resolveAccounts($entries);

        DB::transaction(function () use ($entryGroup, $referenceId, $referenceType, $description, $entries, $accounts): void {
            foreach ($entries as $line) {
                $account = $accounts[$line['account_code']];
                $amount = $line['amount'];

                if ($account->currency !== $amount->currency()) {
                    throw new LedgerOutOfBalance(
                        sprintf(
                            'Account %s is %s but entry is %s.',
                            $account->code,
                            $account->currency,
                            $amount->currency(),
                        ),
                    );
                }

                LedgerEntry::query()->create([
                    'entry_group' => $entryGroup,
                    'account_id' => $account->id,
                    'amount_cents' => $amount->cents(),
                    'debit' => $line['debit'],
                    'currency' => $amount->currency(),
                    'reference_id' => $referenceId,
                    'reference_type' => $referenceType,
                    'description' => $description,
                ]);
            }
        });
    }

    /**
     * Validates that total debits equal total credits across the same currency.
     *
     * @param  array<int, array{account_code: string, amount: Money, debit: bool}>  $entries
     */
    private function assertBalanced(array $entries): void
    {
        $currency = null;
        $debits = 0;
        $credits = 0;

        foreach ($entries as $line) {
            $amount = $line['amount'];
            $currency ??= $amount->currency();

            if ($amount->currency() !== $currency) {
                throw new LedgerOutOfBalance('Ledger entries must share a single currency.');
            }

            if ($line['debit']) {
                $debits += $amount->cents();
            } else {
                $credits += $amount->cents();
            }
        }

        if ($debits !== $credits) {
            throw new LedgerOutOfBalance(
                sprintf('Ledger out of balance: debits=%d credits=%d.', $debits, $credits),
            );
        }
    }

    /**
     * @param  array<int, array{account_code: string, amount: Money, debit: bool}>  $entries
     * @return array<string, Account>
     */
    private function resolveAccounts(array $entries): array
    {
        $codes = array_values(array_unique(array_column($entries, 'account_code')));
        $accounts = Account::query()->whereIn('code', $codes)->get()->keyBy('code');

        foreach ($codes as $code) {
            if (! $accounts->has($code)) {
                throw new InvalidArgumentException("Ledger account not found: {$code}");
            }
        }

        return $accounts->all();
    }
}
