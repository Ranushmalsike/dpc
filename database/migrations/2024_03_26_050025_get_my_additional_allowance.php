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
            CREATE FUNCTION get_my_additional_allowance(
    user_id_param INT,
    yearMonth_param VARCHAR(7)
)
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    DECLARE myAdditionalAllowance DECIMAL(10,2);

    SELECT SUM(additional_allowances.allowance_amount) INTO myAdditionalAllowance
    FROM how_gen_salaries
    LEFT JOIN additional_allowances ON how_gen_salaries.additional_allowance_id = additional_allowances.id
    WHERE how_gen_salaries.user_id = user_id_param
      AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- In case there are no matches, ensure we return 0 instead of NULL
    RETURN IFNULL(myAdditionalAllowance, 0);
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS get_my_additional_allowance'); 
    }
};
