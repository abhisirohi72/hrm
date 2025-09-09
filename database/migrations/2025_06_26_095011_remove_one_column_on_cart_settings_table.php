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
            $table->dropColumn('payment_mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_settings', function (Blueprint $table) {
            $table->enum("payment_mode", ['wallet', 'cod', 'online'])->default('wallet')->comment('Payment mode for cart');
        });
    }
};
