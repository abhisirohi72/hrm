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
        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string("timming")->comment('0 = Once, 1 = Daily, 2 = Weekly, 3 = Monthly, 4 = Quarterly, 5 = Half-Yearly, 6= Yearly')->default(0);
            $table->date('date')->nullable();
            $table->string('title')->nullable();
            $table->text('sop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sops');
    }
};
