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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name of the discount');
            $table->text('description')->nullable()->comment('Description of the discount');
            $table->enum('discount_type', ['percentage', 'fixed'])->comment('Type of discount');
            $table->decimal('discount_value', 10, 2)->comment('Value of the discount');
            $table->date('start_date')->comment('Start date of the discount');
            $table->date('end_date')->comment('End date of the discount');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Status of the discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
