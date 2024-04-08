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
DB::unprepared("         
          CREATE VIEW salary_summary_by_month AS
SELECT 
    DATE_FORMAT(hgs.today_day, '%Y-%m') AS salary_month,
    COALESCE(SUM(sc.salary_on_schedul), 0.00) AS schedule_total,
    COALESCE(SUM(at.allowance), 0.00) AS allowance_total,
    COALESCE(SUM(aa.allowance_amount), 0.00) AS additional_allowance_total,
    COALESCE(SUM(tpd.transport_price), 0.00) AS transport_total,
    COALESCE(SUM(cred.installment), 0.00) AS credit_total,
    (COALESCE(SUM(sc.salary_on_schedul), 0) + 
     COALESCE(SUM(at.allowance), 0) + 
     COALESCE(SUM(aa.allowance_amount), 0) + 
     COALESCE(SUM(tpd.transport_price), 0) - 
     COALESCE(SUM(cred.installment), 0)) AS groupnetSumV
FROM 
    how_gen_salaries hgs
LEFT JOIN schedul_cals sc ON hgs.schedule_id = sc.id
LEFT JOIN allowance_for_users afu ON hgs.user_id = afu.user_id -- Assuming a user_id column to join on
LEFT JOIN allowance_tbs at ON afu.allowance_id = at.id
LEFT JOIN additional_allowances aa ON hgs.additional_allowance_id = aa.id
LEFT JOIN transpoer_price_details tpd ON hgs.trp_transport_id = tpd.id
LEFT JOIN credit_t_b_d2s cred ON hgs.credit_id = cred.id
GROUP BY salary_month;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS salary_summary_by_month');
    }
};
