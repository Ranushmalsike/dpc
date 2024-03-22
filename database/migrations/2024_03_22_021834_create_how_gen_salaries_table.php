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
        Schema::create('how_gen_salaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('today_day');
            $table->text('description');
            $table->bigInteger('schedule_id')->nullable();
            $table->bigInteger('trp_transport_id')->nullable();
            $table->bigInteger('additional_allowance_id')->nullable();
            $table->bigInteger('credit_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_gen_salaries');
    }
};

