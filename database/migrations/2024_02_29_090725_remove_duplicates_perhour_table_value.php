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
        //
    //             DB::unprepared("         
    //     CREATE PROCEDURE RemoveDuplicatesPerhourTableValue()
    //     BEGIN
    //         DELETE ph1
    //         FROM per_houser_salary_for_techers ph1
    //         JOIN per_houser_salary_for_techers hs1 
    //           ON ph1.perHourSalary = hs1.perHourSalary 
    //          AND ph1.user_id = hs1.user_id
    //          AND ph1.id > hs1.id;
    //     END 
    // ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
         // DB::unprepared('DROP PROCEDURE IF EXISTS RemoveDuplicatesPerhourTableValue');        
    }
};
