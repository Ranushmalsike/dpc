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
            CREATE FUNCTION total_additional_tasks(yearMonth VARCHAR(7), sessionID INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE totalTasks INT;

    SELECT COUNT(Trp_for_whom_user_id) INTO totalTasks
    FROM time_arrangemtn_confirm_and_transfers
    WHERE DATE_FORMAT(Time_arrangement, '%Y-%m') = yearMonth
    AND Trp_for_whom_user_id = sessionID
    AND Trp_confirmed = 1;

    RETURN totalTasks;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS total_additional_tasks'); 
    }
};
