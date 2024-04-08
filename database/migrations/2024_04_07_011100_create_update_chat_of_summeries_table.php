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
      DB::unprepared("         
        CREATE PROCEDURE Update_chat_of_summery(
    IN summeryId INT,
    IN cellIndex INT,
    IN getSessionID INT
)
BEGIN
    DECLARE roleType VARCHAR(255);

    -- Get the role type of the user
    SELECT user_roles.roleType INTO roleType
    FROM users
    JOIN user_roles ON users.user_role = user_roles.id
    WHERE users.id = getSessionID
    LIMIT 1;

    -- Check the role and update accordingly
    IF roleType = 'admin' OR roleType = 'staff' THEN
        UPDATE chat_of_summeries
        SET staff_id_view = 1
        WHERE summery_id = summeryId AND Column_id = cellIndex;
    ELSE
        UPDATE chat_of_summeries
        SET teacher_id_view = 1
        WHERE summery_id = summeryId AND teacher_id = getSessionID AND Column_id = cellIndex;
    END IF;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       DB::unprepared('DROP PROCEDURE IF EXISTS Update_chat_of_summery');
    }
};
