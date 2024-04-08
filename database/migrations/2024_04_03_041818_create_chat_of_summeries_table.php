<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_of_summeries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('summery_id');
            $table->dateTime('chat_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('chat_staff')->nullable();
            $table->bigInteger('staff_id')->nullable();
            $table->tinyInteger('staff_id_view')->default(0);
            $table->text('chat_teacher')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->tinyInteger('teacher_id_view')->default(0);
            $table->tinyInteger('Column_id');
            $table->timestamps();
            // $table->unsignedBigInteger('summery_id');
            // $table->foreign('summery_id')->references('id')->on('summery_schemas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_of_summeries');
    }
};
