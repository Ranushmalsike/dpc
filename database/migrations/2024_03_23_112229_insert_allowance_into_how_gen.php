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
        //Insert_allowance_into_how_gen
    DB::unprepared("         
        CREATE PROCEDURE Insert_allowance_into_how_gen(IN p_user_id BIGINT, IN p_additional_allowance_id BIGINT)
    BEGIN
        INSERT INTO how_gen_salaries(user_id, additional_allowance_id, today_day)
        VALUES (p_user_id, p_additional_allowance_id, CURDATE());
    END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS Insert_allowance_into_how_gen');
    }
};
