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
        Schema::create('time_arrangemtn_confirm_and_transfers', function (Blueprint $table) {
            $table->id();
            $table->date('Time_arrangement');
            $table->time('start_time');
            $table->time('end_time');
            $table->bigInteger('user_id');
            $table->bigInteger('class_id');
            $table->bigInteger('subject_id');
            $table->bigInteger('transport_id')->default(1);
            $table->tinyInteger('confirm')->default(0);
            $table->tinyInteger('Transfer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_arrangemtn_confirm_and_transfers');
    }
};
