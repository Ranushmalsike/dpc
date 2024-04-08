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
CREATE FUNCTION get_confirmed_transfers_count(in_user_id VARCHAR(255), in_year_month CHAR(7))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE result_count INT;

    SELECT COUNT(id) INTO result_count
    FROM `time_arrangemtn_confirm_and_transfers`
    WHERE `user_id` = in_user_id
      AND DATE_FORMAT(Time_arrangement, '%Y-%m') = in_year_month
      AND `confirm` = '1';

    RETURN result_count;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS get_confirmed_transfers_count'); 
    }
};
