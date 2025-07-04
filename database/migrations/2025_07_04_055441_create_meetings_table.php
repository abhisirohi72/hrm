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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("assing_to");
            $table->date("date");
            $table->integer("meeting_template")->nullable();
            $table->string("title");
            $table->text("message");
            $table->string("customer_name");
            $table->enum("status", [0,1,2])->comment('0=Pending, 1=Completed, 2=Missing')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
