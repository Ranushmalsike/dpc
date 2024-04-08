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
            CREATE FUNCTION `total_received_task`(
    yearMonth VARCHAR(7), 
    getSessionID INT
)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE taskCount INT;
    
    SELECT COUNT(user_id) INTO taskCount
    FROM time_arrangemtn_confirm_and_transfers
    WHERE DATE_FORMAT(Time_arrangement, '%Y-%m') = yearMonth
      AND user_id = getSessionID;
      
    RETURN taskCount;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS total_received_task'); 
    }
};
