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
            $table->dropForeign(['product_id']);
            $table->dropColumn('discount');
            $table->dropColumn('p_price');
            $table->dropColumn('qnty');
            $table->dropColumn('t_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId("product_id")->constrained()->onDelete('cascade');
            $table->float("discount")->nullable();
            $table->float("p_price");
            $table->integer("qnty");
            $table->integer("t_price");
        });
    }
};
