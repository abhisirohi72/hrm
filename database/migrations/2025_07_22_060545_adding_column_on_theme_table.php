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
        Schema::table('themes', function (Blueprint $table) {
            $table->string("theme_slug")->after("name");
            $table->enum("status", ["0", "1"])->default("1");
            $table->enum("is_deleted", ["0","1"])->default("1")->after("status");
            $table->boolean("is_selected")->default(0)->after('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('themes', function (Blueprint $table) {
            $table->dropColumn(['theme_slug', 'status', 'is_deleted', 'is_selected']);
        });
    }
};
