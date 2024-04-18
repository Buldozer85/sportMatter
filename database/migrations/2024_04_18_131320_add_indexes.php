<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->index('date_of_match');
        });

        Schema::table('season_has_teams', function (Blueprint $table) {
            $table->index('points');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->fullText(['first_name', 'last_name']);
        });
    }

    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropIndex('date_of_match');
        });

        Schema::table('season_has_teams', function (Blueprint $table) {
            $table->dropIndex('points');
        });

        Schema::table('users', function (Blueprint $table) {

            $table->dropFullText(['first_name', 'last_name']);
        });
    }
};
