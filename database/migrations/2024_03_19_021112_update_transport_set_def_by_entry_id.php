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
            CREATE PROCEDURE updateTransportSetDefByEntryId(IN entryId INT)
            BEGIN
                DECLARE transportCode VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

                -- Retrieve the trasporot_code for the given entryId
                SELECT trasporot_code INTO transportCode FROM transpoer_price_details WHERE id = entryId LIMIT 1;

                -- Check if transportCode was successfully retrieved
                IF transportCode IS NOT NULL THEN
                    -- Reset setDef for all entries with the same transportCode
                    UPDATE transpoer_price_details
                    SET setDef = 0
                    WHERE trasporot_code COLLATE utf8mb4_unicode_ci = transportCode AND setDef = 1;

                    -- Set setDef to 1 for the specified entryId
                    UPDATE transpoer_price_details
                    SET setDef = 1
                    WHERE id = entryId;
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
         DB::unprepared('DROP PROCEDURE IF EXISTS updateTransportSetDefByEntryId');
    }
};
