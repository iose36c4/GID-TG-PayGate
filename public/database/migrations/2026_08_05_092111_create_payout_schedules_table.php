<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payout_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_pago_id')->constrained()->cascadeOnDelete();
            $table->enum('frequency', ['weekly', 'biweekly', 'monthly', 'quarterly'])->default('monthly');
            $table->decimal('minimum_amount', 12, 2)->default(1000);
            $table->decimal('platform_fee_percentage', 5, 4)->default(0.0500)->comment('5% platform fee');
            $table->decimal('gateway_fee_percentage', 5, 4)->default(0.0350)->comment('3.5% gateway fee');
            $table->decimal('fixed_fee', 10, 2)->default(50)->comment('Fixed fee per payout in cents');
            $table->date('next_payout_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['channel_pago_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payout_schedules');
    }
};
