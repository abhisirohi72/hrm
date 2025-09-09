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
        Schema::create('shop_footers', function (Blueprint $table) {
            $table->id();
            $table->longText("mini_desc")->nullable();
            $table->string("c_name")->nullable();
            $table->longText("fb_url")->nullable();
            $table->longText("insta_url")->nullable();
            $table->longText("twitter_url")->nullable();
            $table->longText("linkedin_url")->nullable();
            $table->longText("youtube_url")->nullable();
            $table->longText("contact")->nullable();
            $table->longText("c_email")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_footers');
    }
};
