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
           CREATE FUNCTION get_allowance(
    user_id_param INT,
    yearMonth_param VARCHAR(7)
)
RETURNS DECIMAL(10,2) -- Assuming allowance is a DECIMAL type; adjust as needed
DETERMINISTIC
BEGIN
    DECLARE allowanceAmount DECIMAL(10,2);

    SELECT SUM(allowance_tbs.allowance) INTO allowanceAmount -- If you expect multiple rows, use SUM or another aggregate function
    FROM allowance_for_users
    JOIN allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
    WHERE allowance_for_users.user_id = user_id_param
      AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = yearMonth_param;

    -- In case there are no matches, ensure we return 0 instead of NULL
    RETURN IFNULL(allowanceAmount, 0);
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS get_allowance'); 
    }
};
