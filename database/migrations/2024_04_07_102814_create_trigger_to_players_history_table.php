<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER player_switched_teams AFTER UPDATE ON players FOR EACH ROW
            BEGIN
                IF OLD.team_id != NEW.team_id THEN
                    INSERT INTO player_history (date_of_transfer, player_id, team_id, created_at, updated_at)
                    VALUES(NOW(), OLD.id, OLD.team_id, NOW(), NOW());
                END IF;
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS player_switched_teams');
    }
};
