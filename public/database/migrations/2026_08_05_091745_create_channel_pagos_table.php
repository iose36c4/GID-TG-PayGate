<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('channel_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('cover_image')->nullable();

            // Telegram
            $table->unsignedBigInteger('telegram_chat_id')->nullable()->unique();
            $table->text('telegram_bot_token')->nullable()->comment('Cifrado AES-256');
            $table->string('telegram_bot_username')->nullable();
            $table->string('telegram_invite_link')->nullable();

            // Configuración
            $table->enum('status', ['draft', 'pending', 'active', 'paused', 'archived'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'hidden'])->default('private');

            // Precios
            $table->decimal('price', 12, 2)->default(0);
            $table->string('currency', 3)->default('ARS');
            $table->enum('billing_cycle', ['monthly', 'quarterly', 'yearly', 'lifetime'])->default('monthly');
            $table->unsignedInteger('trial_days')->default(0);

            // Métricas
            $table->unsignedInteger('subscribers_count')->default(0);
            $table->decimal('revenue_total', 14, 2)->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['owner_id', 'status']);
            $table->index('slug');
            $table->index('telegram_chat_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('channel_pagos');
    }
};
