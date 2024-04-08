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
        DB::unprepared('SET GLOBAL event_scheduler = ON;');
        DB::unprepared("
            CREATE EVENT IF NOT EXISTS `process_loan_deduction`
            ON SCHEDULE EVERY 1 MONTH
            STARTS CURRENT_DATE + INTERVAL 1 DAY
            DO
            BEGIN
                CREATE TEMPORARY TABLE TempCreditData (
                    credit_t_b_d2s_id BIGINT(20),
                    credit_id BIGINT(20),
                    user_id BIGINT(20)
                );

                INSERT INTO TempCreditData (credit_t_b_d2s_id, credit_id, user_id)
                SELECT d2.id, d2.credit_id, d1.user_id
                FROM credit_t_b_d2s AS d2
                JOIN credit_t_b_d1s AS d1 ON d2.credit_id = d1.id
                WHERE d2.installment_date = CURRENT_DATE;

                UPDATE credit_t_b_d2s AS d2
                JOIN TempCreditData AS temp ON d2.id = temp.credit_t_b_d2s_id
                SET d2.type_id = 1
                WHERE d2.installment_date = CURRENT_DATE;

                INSERT INTO how_gen_salaries (user_id, credit_id, today_day)
                SELECT user_id, credit_id, CURRENT_DATE()
                FROM TempCreditData;

                DROP TEMPORARY TABLE IF EXISTS TempCreditData;
            END
        ");        
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP EVENT IF EXISTS `process_loan_deduction`;');
    }
};
