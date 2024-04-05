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
            CREATE FUNCTION get_transport_price_sum(
    user_id_param INT,
    yearMonth_param VARCHAR(7)
)
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    DECLARE transportPriceSum DECIMAL(10,2);

    SELECT SUM(transpoer_price_details.transport_price) INTO transportPriceSum
    FROM how_gen_salaries
    RIGHT JOIN transpoer_price_details ON how_gen_salaries.trp_transport_id = transpoer_price_details.id
    WHERE how_gen_salaries.user_id = user_id_param
      AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- Ensure we return 0 instead of NULL if no matches are found
    RETURN IFNULL(transportPriceSum, 0);
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS get_transport_price_sum'); 
    }
};
