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
            $table->decimal('total_price', 10, 2)->default(0.00)->after('billing_address');
            $table->decimal('discount', 10, 2)->default(0.00)->after('total_price');
            $table->decimal("final_price", 10, 2)->default(0.00)->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('total_price');
            $table->dropColumn('discount');
            $table->dropColumn('final_price');
        });
    }
};
