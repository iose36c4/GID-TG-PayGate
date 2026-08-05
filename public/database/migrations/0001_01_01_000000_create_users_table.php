<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->enum('role', ['user', 'creador', 'staff', 'admin'])->default('user');
            $table->unsignedBigInteger('telegram_id')->nullable()->unique();
            $table->json('settings')->nullable()->comment('Preferencias UI, notificaciones, 2FA');
            $table->string('timezone')->default('UTC');
            $table->string('locale')->default('es');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();

            // Onboarding
            $table->tinyInteger('onboarding_step')->default(1);
            $table->timestamp('onboarding_completed_at')->nullable();

            // Fiscal (Argentina)
            $table->string('taxpayer_type')->nullable()->comment('responsable_inscripto, monotributo, exento, consumidor_final');
            $table->string('cuit_cuil')->nullable()->unique()->comment('CUIT/CUIL validado módulo 11');
            $table->string('tax_province')->nullable()->comment('Código provincia AR');
            $table->string('tax_city')->nullable();
            $table->string('tax_zip_code')->nullable();
            $table->text('tax_address')->nullable();
            $table->string('iibb_number')->nullable();
            $table->char('monotributo_category', 1)->nullable();
            $table->boolean('ganancias_exempt')->default(false);
            $table->boolean('iva_exempt')->default(false);

            $table->timestamps();

            $table->index(['role', 'is_active']);
            $table->index('telegram_id');
            $table->index('onboarding_step');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
