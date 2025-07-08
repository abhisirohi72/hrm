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
        Schema::table('whats_app_flows', function (Blueprint $table) {
            $table->string("image")->nullable()->after("reply");
            $table->string("document")->nullable()->after("image");
            $table->string("filename")->nullable()->after("document");
            $table->string("audio")->nullable()->after("filename");
            $table->string("video")->nullable()->after("audio");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whats_app_flows', function (Blueprint $table) {
            $table->dropColumn(['image', 'document', 'filename', 'audio', 'video']);
        });
    }
};
