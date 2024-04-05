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
   CREATE FUNCTION GetConfirmedArrangementsCount(monthYear VARCHAR(7))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE countConfirmed INT;

    SELECT COUNT(time_arrangemtn_confirm_and_transfers.confirm) INTO countConfirmed
    FROM time_arrangemtn_confirm_and_transfers
    WHERE DATE_FORMAT(time_arrangemtn_confirm_and_transfers.Time_arrangement, '%Y-%m') = monthYear;

    RETURN countConfirmed;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP FUNCTION IF EXISTS GetConfirmedArrangementsCount');  
    }
};
