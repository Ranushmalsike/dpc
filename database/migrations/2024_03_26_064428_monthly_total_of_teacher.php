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
           CREATE FUNCTION monthly_total_of_teacher(
    user_id_param INT,
    yearMonth_param VARCHAR(7)
)
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
    DECLARE scheduleV DECIMAL(10,2) DEFAULT 0.00;
    DECLARE allowanceV DECIMAL(10,2) DEFAULT 0.00;
    DECLARE additional_allowance_V DECIMAL(10,2) DEFAULT 0.00;
    DECLARE transportV DECIMAL(10,2) DEFAULT 0.00;
    DECLARE installmentSumV DECIMAL(10,2) DEFAULT 0.00;
    DECLARE netSumV DECIMAL(10,2);

    -- schedule
    SELECT COALESCE(SUM(schedul_cals.salary_on_schedul), 0.00) INTO scheduleV
    FROM how_gen_salaries
    JOIN schedul_cals ON how_gen_salaries.schedule_id = schedul_cals.id
    WHERE how_gen_salaries.user_id = user_id_param
    AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- allowance
    SELECT COALESCE(SUM(allowance_tbs.allowance), 0.00) INTO allowanceV
    FROM allowance_for_users
    JOIN allowance_tbs ON allowance_for_users.allowance_id = allowance_tbs.id
    WHERE allowance_for_users.user_id = user_id_param
    AND DATE_FORMAT(allowance_for_users.define_month, '%Y-%m') = yearMonth_param;

    -- additional Allowance
    SELECT COALESCE(SUM(additional_allowances.allowance_amount), 0.00) INTO additional_allowance_V
    FROM how_gen_salaries
    LEFT JOIN additional_allowances ON how_gen_salaries.additional_allowance_id = additional_allowances.id
    WHERE how_gen_salaries.user_id = user_id_param
    AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- transport
    SELECT COALESCE(SUM(transpoer_price_details.transport_price), 0.00) INTO transportV
    FROM how_gen_salaries
    RIGHT JOIN transpoer_price_details ON how_gen_salaries.trp_transport_id = transpoer_price_details.id
    WHERE how_gen_salaries.user_id = user_id_param
    AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- credit
    SELECT COALESCE(SUM(credit_t_b_d2s.installment), 0.00) INTO installmentSumV
    FROM how_gen_salaries
    RIGHT JOIN credit_t_b_d2s ON how_gen_salaries.credit_id = credit_t_b_d2s.id
    WHERE how_gen_salaries.user_id = user_id_param
    AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = yearMonth_param;

    -- Calculate net sum
    SET netSumV = (scheduleV + allowanceV + additional_allowance_V + transportV) - installmentSumV;

    RETURN netSumV;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
       DB::unprepared('DROP FUNCTION IF EXISTS monthly_total_of_teacher');  
    }
};
