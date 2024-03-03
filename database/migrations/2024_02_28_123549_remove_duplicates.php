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
        // DB::unprepared("         
        // CREATE PROCEDURE RemoveDuplicates()
        // BEGIN
        //     DELETE p1
        //     FROM permission_pageforusers p1
        //     JOIN permission_pageforusers p2 
        //       ON p1.permission_id = p2.permission_id 
        //      AND p1.user_id = p2.user_id
        //      AND p1.id > p2.id;
        // END 
    // ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         // DB::unprepared('DROP PROCEDURE IF EXISTS RemoveDuplicates');
    }
};
