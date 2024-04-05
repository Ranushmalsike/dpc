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
    DB::unprepared("         
            CREATE FUNCTION confirm_schedule_Completed(yearMonth VARCHAR(7), userId INT)
    RETURNS INT
    DETERMINISTIC
    BEGIN
        DECLARE cnfOwnerTask INT;

        SELECT COUNT(confirm) INTO cnfOwnerTask
        FROM time_arrangemtn_confirm_and_transfers
        WHERE user_id = userId
        AND DATE_FORMAT(Time_arrangement, '%Y-%m') = yearMonth
        AND confirm = 1;

        RETURN cnfOwnerTask;
    END;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS confirm_schedule_Completed'); 
    }
};
