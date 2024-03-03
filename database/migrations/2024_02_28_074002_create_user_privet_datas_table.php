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
        Schema::create('user_privet_datas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->string('first_name')->nullable();
            $table->string('second_name')->nullable();
            $table->text('address')->nullable();
            $table->string('NIC')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('user_id')->references('id')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_privet_datas');
    }
};
