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
            CREATE FUNCTION `get_total_salary_of_mounthly_schedule`(userId VARCHAR(255), queryDate VARCHAR(10))
    RETURNS DECIMAL(65,2)
    DETERMINISTIC
    BEGIN
        DECLARE total_salary DECIMAL(65, 2);

        SELECT 
            IF(SUM(schedul_cals.salary_on_schedul) IS NULL OR SUM(schedul_cals.salary_on_schedul) = 0, '0.00', SUM(schedul_cals.salary_on_schedul)) INTO total_salary
        FROM
            how_gen_salaries
        JOIN
            schedul_cals ON how_gen_salaries.schedule_id = schedul_cals.id
        WHERE
            how_gen_salaries.user_id = userId
            AND DATE_FORMAT(how_gen_salaries.today_day, '%Y-%m') = queryDate;

        RETURN  IFNULL(total_salary, 0);
    END;");
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
       DB::unprepared('DROP FUNCTION IF EXISTS get_total_salary_of_mounthly_schedule'); 
    }
};
