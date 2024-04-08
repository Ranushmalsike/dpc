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
           CREATE FUNCTION get_credit_installment_sum(
    user_id_param INT,
    yearMonth_param VARCHAR(7)
)
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    DECLARE installmentSum DECIMAL(10,2);

    SELECT SUM(credit_t_b_d2s.installment) INTO installmentSum
    FROM how_gen_salaries
    RIGHT JOIN credit_t_b_d2s ON how_gen_salaries.credit_id = credit_t_b_d2s.id
    WHERE how_gen_salaries.user_id = user_id_param
      AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- In case there are no matches, ensure we return 0 instead of NULL
    RETURN IFNULL(installmentSum, 0);
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS get_credit_installment_sum');
    }
};
