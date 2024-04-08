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
       CREATE PROCEDURE ProcessCreditInstallments()
BEGIN
    -- Temporary table to store IDs and related data
    CREATE TEMPORARY TABLE TempCreditData (
        credit_t_b_d2s_id BIGINT(20),
        credit_id BIGINT(20),
        user_id BIGINT(20)
    );
    
    -- Insert matching records' IDs and related data into the temporary table
    INSERT INTO TempCreditData (credit_t_b_d2s_id, credit_id, user_id)
    SELECT d2.id, d2.credit_id, d1.user_id
    FROM credit_t_b_d2s AS d2
    JOIN credit_t_b_d1s AS d1 ON d2.credit_id = d1.id
    WHERE d2.installment_date = CURRENT_DATE();
    
    -- Update `type_id` in `credit_t_b_d2s` for the relevant records
    UPDATE credit_t_b_d2s AS d2
    JOIN TempCreditData AS temp ON d2.id = temp.credit_t_b_d2s_id
    SET d2.type_id = 1
    WHERE d2.installment_date = CURRENT_DATE();
    
    -- Insert into `how_gen_salaries`
    INSERT INTO how_gen_salaries (user_id, credit_id, today_day)
    SELECT user_id, credit_id, CURRENT_DATE()
    FROM TempCreditData;
    
    -- Drop the temporary table
    DROP TEMPORARY TABLE IF EXISTS TempCreditData;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS ProcessCreditInstallments');
    }
};

