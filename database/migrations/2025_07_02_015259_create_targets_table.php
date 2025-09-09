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
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->string('target_name');
            $table->date('target_start_date');
            $table->date('target_end_date')->nullable()->default(null)->comment('Target End Date');
            $table->enum('target_type', ['0', '1'])->comment('0=No. Of Leads,1=Total Collections');
            $table->decimal('target_amount', 10, 2)->nullable()->default(0.00)->comment('Target Amount');
            $table->decimal('target_achieved', 10, 2)->nullable()->default(0.00)->comment('Target Achieved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
