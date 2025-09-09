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
        Schema::create('home_custom_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("theme_id");
            $table->string("icon");
            $table->string("title");
            $table->string("desc");
            $table->string("url");
            $table->enum("status", ['0','1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_custom_data');
    }
};
