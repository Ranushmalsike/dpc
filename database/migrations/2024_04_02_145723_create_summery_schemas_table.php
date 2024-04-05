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
        Schema::create('summery_schemas', function (Blueprint $table) {
            $table->id();
            $table->char('month_of_summery', 25);
            $table->text('summery_col_1');
            $table->tinyInteger('Percentage_sum_co_1')->nullable()->default(0);
            $table->text('summery_col_2');
            $table->tinyInteger('Percentage_sum_co_2')->nullable()->default(0);
            $table->text('summery_col_3');
            $table->tinyInteger('Percentage_sum_co_3')->nullable()->default(0);
            $table->text('summery_col_4');
            $table->tinyInteger('Percentage_sum_co_4')->nullable()->default(0);
            $table->text('summery_col_5');
            $table->tinyInteger('Percentage_sum_co_5')->nullable()->default(0);
            $table->text('summery_col_6');
            $table->tinyInteger('Percentage_sum_co_6')->nullable()->default(0);
            $table->text('summery_col_7');
            $table->tinyInteger('Percentage_sum_co_7')->nullable()->default(0);
            $table->bigInteger('class_id');
            $table->timestamps();
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summery_schemas');
    }
};
