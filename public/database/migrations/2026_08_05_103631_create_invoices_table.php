<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('channel_pago_id')->constrained()->cascadeOnDelete();

            // Número de factura
            $table->string('invoice_number')->unique();

            // Datos fiscales
            $table->json('issuer_data')->comment('Datos del emisor - creador');
            $table->json('receiver_data')->comment('Datos del receptor - usuario');
            $table->json('items')->comment('Líneas de factura');

            // Montos
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->string('currency', 3)->default('ARS');

            // Estado AFIP/ARCA
            $table->enum('afip_status', ['pending', 'authorized', 'rejected', 'cancelled'])->default('pending');
            $table->string('cae')->nullable()->comment('Código de Autorización Electrónico');
            $table->timestamp('cae_expires_at')->nullable();
            $table->string('afip_qr')->nullable();

            // PDF
            $table->string('pdf_path')->nullable();

            $table->timestamps();

            $table->index(['subscription_id', 'afip_status']);
            $table->index('invoice_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
