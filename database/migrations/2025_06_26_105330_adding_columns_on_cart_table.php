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
        Schema::table('carts', function (Blueprint $table) {
            $table->enum("payment_mode", ['wallet', 'cod', 'online'])->default('cod')->after('user_id');
            $table->string("transaction_id")->nullable()->after('payment_mode');
            $table->string("order_status")->default('pending')->after('transaction_id');
            $table->string("shipping_address")->nullable()->after('order_status');
            $table->string("billing_address")->nullable()->after('shipping_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn([
                'payment_mode',
                'transaction_id',
                'order_status',
                'shipping_address',
                'billing_address'
            ]);
        });
    }
};
