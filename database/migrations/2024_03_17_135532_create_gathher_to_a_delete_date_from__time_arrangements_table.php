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
        Schema::create('gathher_to_a_delete_date_from__time_arrangements', function (Blueprint $table) {
            $table->id();
            $table->date('delete_date_from_TimeArrangement');
            $table->text('Description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gathher_to_a_delete_date_from__time_arrangements');
    }
};
