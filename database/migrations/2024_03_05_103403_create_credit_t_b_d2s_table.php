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
        Schema::create('credit_t_b_d2s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('credit_id');
            $table->decimal('installment', 10, 2);
            $table->bigInteger('type_id')->default(1);
            $table->date('installment_date');
            $table->timestamps();
            
            // Define the foreign key relationship
            // $table->foreign('credit_id')->references('id')->on('credit_t_b_d1s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_t_b_d2s');
    }
};
