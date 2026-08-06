<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class LedgerAccountSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['code' => 'cash_platform', 'type' => 'asset', 'currency' => 'ARS', 'name' => 'Caja plataforma (ARS)'],
            ['code' => 'payable_creator', 'type' => 'liability', 'currency' => 'ARS', 'name' => 'A pagar a creador (ARS)'],
            ['code' => 'commission_revenue', 'type' => 'revenue', 'currency' => 'ARS', 'name' => 'Ingresos por comisión (ARS)'],
            ['code' => 'fee_expense', 'type' => 'expense', 'currency' => 'ARS', 'name' => 'Gastos por fee pasarela (ARS)'],
            ['code' => 'pending_settlement', 'type' => 'asset', 'currency' => 'ARS', 'name' => 'Settlement pendiente (ARS)'],
        ];

        foreach ($accounts as $account) {
            Account::query()->firstOrCreate(['code' => $account['code']], $account);
        }
    }
}
