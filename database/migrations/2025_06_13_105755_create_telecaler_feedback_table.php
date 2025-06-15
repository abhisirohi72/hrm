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
        Schema::create('telecaler_feedback', function (Blueprint $table) {
            $table->id();
            $table->string("customer_name");
            $table->string("contact_number")->nullable();
            $table->enum("call_purpose", ['0','1','2','3'])->default('0')->comment('0=Inquiry,1=Follow-up,2=Promotion,3=Complaint');
            $table->enum('insterested', ['0','1'])->default('0');
            $table->longText("feedback_notes")->nullable();
            $table->longText("next_followup")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telecaler_feedback');
    }
};
