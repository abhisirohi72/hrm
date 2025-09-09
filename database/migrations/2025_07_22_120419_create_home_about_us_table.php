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
        Schema::create('home_about_us', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("theme_id");
            $table->longText("desc");
            $table->string("icon");
            $table->text("title");
            $table->longText("s_desc");
            $table->enum("status", ['0','1'])->defautl('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_about_us');
    }
};
