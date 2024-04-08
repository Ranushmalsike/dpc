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
        CREATE TRIGGER schedule_calculation_by_trigger
        BEFORE INSERT ON how_gen_salaries
        FOR EACH ROW
        BEGIN
            -- Check if schedule_id, trp_transport_id, or additional_allowance_id is present
            IF NEW.schedule_id IS NOT NULL OR NEW.trp_transport_id IS NOT NULL OR NEW.additional_allowance_id IS NOT NULL THEN
                -- Logic for credit in description
                SET NEW.description = CONCAT(NEW.description, 'Debit');
            -- Otherwise, check if credit_id is present
            ELSEIF NEW.credit_id IS NOT NULL THEN
                -- Logic for debit in description
                SET NEW.description = CONCAT(NEW.description, 'Credit');
            END IF;
        END
    ");
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS schedule_calculation_by_trigger');
    }
};
