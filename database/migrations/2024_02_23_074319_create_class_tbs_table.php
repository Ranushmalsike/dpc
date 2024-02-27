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
        Schema::create('class_tbs', function (Blueprint $table) {
            $table->id();
            $table->string('dpcclass', '255')->nullable()->unique();
            $table->date('start_date')->nullable();  // Optional if not every class has a start date
            $table->date('end_date')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_tbs');
    }
};
