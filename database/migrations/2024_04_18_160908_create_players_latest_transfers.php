<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('
          CREATE VIEW players_latest_transfers AS
            SELECT players.first_name, players.last_name, players.id, players.birthdate, players.country_id, players.team_id, players.created_at, players.updated_at, player_history.date_of_transfer FROM players
            INNER JOIN player_history ON players.id = player_history.player_id
            ORDER BY date_of_transfer DESC;
        ');
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS players_latest_transfers;');
    }
};
