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
        Schema::create('per_houser_salary_for_techers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->decimal('perHourSalary', 65,2);
            $table->date('published')->useCurrent();
            $table->index('user_id');
        });


        //  $table->id();
        // $table->foreignId('user_id')->constrained('users'); // Assuming you have a 'users' table
        // $table->decimal('perHourSalary', 65, 2);  // Adjust precision if needed 
        // $table->timestamps();

        // $table->index('user_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('per_houser_salary_for_techers');
    }
};
