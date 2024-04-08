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
    CREATE FUNCTION insert_additional_allowance(p_user_id BIGINT, p_allowance_amount DECIMAL(65,2), p_Description TEXT)
    RETURNS BIGINT
    BEGIN
        -- Insert the data into the table
        INSERT INTO additional_allowances(user_id, allowance_amount, Description)
        VALUES(p_user_id, p_allowance_amount, p_Description);
        
        -- Return the last inserted id
        RETURN LAST_INSERT_ID();
    END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    DB::unprepared('DROP function IF EXISTS insert_additional_allowance');
    }
};
