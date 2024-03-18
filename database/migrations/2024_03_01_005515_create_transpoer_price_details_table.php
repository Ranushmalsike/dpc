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
        Schema::create('transpoer_price_details', function (Blueprint $table) {
            $table->id();
            $table->string('trasporot_code')->constrains('transpoer_details', 'trasporot_code')->onDelete('cascade');
            $table->string('transport_price');
            $table->integer('setDef')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transpoer_price_details');
    }
};
