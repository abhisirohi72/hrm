<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cart_settings', function (Blueprint $table) {
            $table->integer('wallet_payment_mode')->default(1)->after('gst');
            $table->integer('cod_payment_mode')->default(1)->after('wallet_payment_mode');
            $table->integer('online_payment_mode')->default(1)->after('cod_payment_mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_settings', function (Blueprint $table) {
            $table->dropColumn(['wallet_payment_mode', 'cod_payment_mode', 'online_payment_mode']);
        });
    }
};
