<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('channel_pago_id')->constrained()->cascadeOnDelete();

            // Montos
            $table->decimal('amount', 12, 2);
            $table->decimal('net_amount', 12, 2)->comment('Monto neto después de comisiones');
            $table->string('currency', 3)->default('ARS');

            // Comisiones
            $table->decimal('platform_fee', 12, 2)->default(0);
            $table->decimal('gateway_fee', 12, 2)->default(0);
            $table->decimal('fixed_fee', 12, 2)->default(0);

            // Gateway
            $table->string('gateway')->comment('mercadopago, stripe, etc');
            $table->string('gateway_payment_id')->nullable();
            $table->string('gateway_status')->nullable();

            // Estado
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'refunded', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->text('failure_reason')->nullable();

            // Metadatos
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index(['subscription_id', 'status']);
            $table->index(['user_id', 'status']);
            $table->index('gateway_payment_id');
            $table->index('paid_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
