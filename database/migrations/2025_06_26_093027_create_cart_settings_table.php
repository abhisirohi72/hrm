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
        Schema::create('cart_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('gst', 8, 2)->default(0.00)->comment('GST percentage for cart');
            $table->enum("payment_mode", ['wallet', 'cod', 'online'])->default('wallet')->comment('Payment mode for cart');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_settings');
    }
};
