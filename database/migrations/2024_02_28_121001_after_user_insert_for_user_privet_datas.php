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
        
                CREATE TRIGGER after_user_insert_for_user_privet_datas
        AFTER INSERT ON users
        FOR EACH ROW
        BEGIN
            -- Inserting a new record into user_private with the corresponding user_id
            INSERT INTO user_privet_datas (user_id) VALUES (NEW.id);
        END
       
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
