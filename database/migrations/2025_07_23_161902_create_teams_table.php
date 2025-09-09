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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("theme_id");
            $table->string("title");
            $table->longText("desc");
            $table->string("image");
            $table->string("name");
            $table->string("designation");
            $table->longText("s_desc");
            $table->longText("t_url");
            $table->longText("fb_url");
            $table->longText("insta_url");
            $table->longText("linkedin_url");
            $table->enum("status", ['0','1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
