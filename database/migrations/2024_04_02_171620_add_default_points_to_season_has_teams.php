<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('season_has_teams', function (Blueprint $table) {
            $table->integer('points')->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('season_has_teams', function (Blueprint $table) {
            $table->integer('points')->change();
        });
    }
};
