<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->enum('type', ['asset', 'liability', 'equity', 'revenue', 'expense']);
            $table->string('currency', 3)->default('ARS');
            $table->string('name', 120);
            $table->timestamps();
        });

        Schema::create('ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->uuid('entry_group')->index();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->bigInteger('amount_cents');
            $table->boolean('debit');
            $table->string('currency', 3);
            $table->uuid('reference_id')->index();
            $table->string('reference_type')->nullable();
            $table->string('description', 255);
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['entry_group', 'account_id', 'debit']);
            $table->index(['account_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledger_entries');
        Schema::dropIfExists('accounts');
    }
};
