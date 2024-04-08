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
        Schema::create('allowance_tbs', function (Blueprint $table) {
            $table->id();
            $table->decimal('start_salary', 65, 2);
            $table->decimal('end_star', 65, 2);
            $table->decimal('allowance', 65, 2);
            $table->timestamps();
            $table->index(['start_salary', 'end_star']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowance_tbs');
    }
};

