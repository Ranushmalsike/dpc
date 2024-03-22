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
        Schema::create('schedul_cals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('schedule_id_of_cal_gen');
            $table->decimal('time_duration', 65,2);
            $table->bigInteger('user_id');
            $table->decimal('salary_on_schedul', 65, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedul_cals');
    }
};
