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
        Schema::create('home_headers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("theme_id");
            $table->string("bg_img");
            $table->string("title");
            $table->longText("desc");
            $table->longText("custom_col_name");
            $table->longText("custom_col_value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_headers');
    }
};
