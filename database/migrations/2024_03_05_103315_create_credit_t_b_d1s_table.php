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
        Schema::create('credit_t_b_d1s', function (Blueprint $table) {
            $table->id();
            // $table->bigIncrements('credit_id');
            $table->bigInteger('user_id');
            $table->decimal('amount', 65, 2);
            $table->bigInteger('type_id')->default(1);
            $table->date('provide_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_t_b_d1s');
    }
};
