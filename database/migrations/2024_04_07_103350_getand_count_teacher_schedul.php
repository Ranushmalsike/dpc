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
CREATE FUNCTION get_count_teacher_schedule(in_user_id VARCHAR(255), in_year_month CHAR(7))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE count_result INT;

    SELECT COUNT(id) INTO count_result,
    FROM `time_arrangemtn_confirm_and_transfers`
    WHERE `user_id` = in_user_id
      AND DATE_FORMAT(Time_arrangement, '%Y-%m') = in_year_month;

    RETURN count_result;
END");
    }

    /**
     * Reverse the migrations.
     * 
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS get_count_teacher_schedule'); 
    }
};
