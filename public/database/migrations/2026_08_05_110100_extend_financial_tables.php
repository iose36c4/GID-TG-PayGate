<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->uuid('external_reference')->nullable()->unique()->after('id');
            $table->timestamp('activated_at')->nullable()->after('renews_at');
            $table->string('telegram_invite_link', 512)->nullable()->after('activated_at');
            $table->timestamp('invite_expires_at')->nullable()->after('telegram_invite_link');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->uuid('external_reference')->nullable()->unique()->after('id');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->string('status', 30)->default('created')->after('invoice_number');
            $table->unique('payment_id');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropUnique(['external_reference']);
            $table->dropColumn(['external_reference', 'activated_at', 'telegram_invite_link', 'invite_expires_at']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropUnique(['external_reference']);
            $table->dropColumn('external_reference');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropUnique(['payment_id']);
            $table->dropColumn('status');
        });
    }
};
