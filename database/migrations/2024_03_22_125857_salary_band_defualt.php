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
        CREATE PROCEDURE salaryBand_defaults(IN entryId INT)
BEGIN
    DECLARE v_user_id BIGINT;

    -- Retrieve the user_id for the given entryId
    SELECT user_id INTO v_user_id FROM per_houser_salary_for_techers WHERE id = entryId LIMIT 1;

    -- Check if v_user_id was successfully retrieved
    IF v_user_id IS NOT NULL THEN
        -- Reset Default_set for all entries of the same user_id
        UPDATE per_houser_salary_for_techers
        SET Default_set = 0
        WHERE user_id = v_user_id AND Default_set = 1;

        -- Set Default_set to 1 for the specified entryId
        UPDATE per_houser_salary_for_techers
        SET Default_set = 1
        WHERE id = entryId;
    END IF;
END;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS salaryBand_defaults');
        
    }
};
