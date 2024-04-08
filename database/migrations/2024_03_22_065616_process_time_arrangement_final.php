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
        CREATE PROCEDURE ProcessTimeArrangementFinal(IN arrangement_id BIGINT)
BEGIN
    -- Declare variables
    DECLARE v_user_id, v_transport_id BIGINT;
    DECLARE v_start_time, v_end_time TIME;
    DECLARE v_total_hours, v_perHourSalary, v_salary_on_schedul DECIMAL(10,2);
    DECLARE v_confirm, v_transfer, v_trp_confirmed TINYINT;
    DECLARE v_trp_for_whom_user_id BIGINT;
    DECLARE v_allowance_id BIGINT DEFAULT NULL;
    DECLARE v_today DATE;
    DECLARE has_allowance_this_month BOOLEAN;
    DECLARE continue HANDLER FOR SQLEXCEPTION
    BEGIN
        -- This block will handle SQL exceptions
        ROLLBACK; -- Rollback any transaction if an error occurs
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'An error occurred during procedure execution';
    END;

    START TRANSACTION;

    -- Initialize TODAY date
    SET v_today = CURDATE();

    -- Fetch data based on the arrangement_id
    SELECT confirm, Transfer, Trp_confirmed, user_id, Trp_for_whom_user_id, start_time, end_time, transport_id 
    INTO  v_confirm, v_transfer, v_trp_confirmed, v_user_id, v_trp_for_whom_user_id, v_start_time, v_end_time, v_transport_id 
    FROM time_arrangemtn_confirm_and_transfers 
    WHERE id = arrangement_id;

    -- Logic to determine user_id and transport_id
    IF v_confirm = 1 THEN
        SET v_user_id = v_user_id;
        SET v_transport_id = v_transport_id;

    ELSEIF v_transfer = 1 AND v_trp_confirmed = 1 THEN
        SET v_user_id = v_trp_for_whom_user_id;
        SET v_transport_id = 1;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Conditions for confirm and transfer not met';
    END IF;

    -- Calculate total hours and salary
    SET v_total_hours = TIME_TO_SEC(TIMEDIFF(v_end_time, v_start_time)) / 3600;
    SELECT perHourSalary INTO v_perHourSalary
    FROM per_houser_salary_for_techers
    WHERE user_id = v_user_id AND Default_set = 1;
    SET v_salary_on_schedul = v_total_hours * v_perHourSalary;

    -- Find matching allowance
    SELECT id INTO v_allowance_id
    FROM allowance_tbs
    WHERE v_salary_on_schedul BETWEEN start_salary AND end_star
    ORDER BY start_salary LIMIT 1;

    -- Check for existing allowance record this month
    SELECT EXISTS(SELECT 1 FROM allowance_for_users WHERE user_id = v_user_id AND MONTH(define_month) = MONTH(v_today) AND YEAR(define_month) = YEAR(v_today))
    INTO has_allowance_this_month;

    -- Update or insert allowance_for_users record
    IF has_allowance_this_month THEN
        UPDATE allowance_for_users SET allowance_id = v_allowance_id WHERE user_id = v_user_id AND MONTH(define_month) = MONTH(v_today) AND YEAR(define_month) = YEAR(v_today);
    ELSE
        INSERT INTO allowance_for_users (user_id, allowance_id, define_month) VALUES (v_user_id, v_allowance_id, v_today);
    END IF;

    -- Insert into schedul_cals
    INSERT INTO schedul_cals (schedule_id_of_cal_gen, time_duration, user_id, salary_on_schedul) VALUES (arrangement_id, v_total_hours, v_user_id, v_salary_on_schedul);

    -- Insert into how_gen_salaries
    INSERT INTO how_gen_salaries (schedule_id, user_id, today_day, trp_transport_id) VALUES (arrangement_id, v_user_id, v_today, v_transport_id);

    COMMIT;
END
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS ProcessTimeArrangementFinal');
    }
};
