<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('season_has_teams', function (Blueprint $table) {
            $table->id();
            $table->integer('points');
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('team_id');

            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('team_id')->references('id')->on('teams');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('season_has_teams');
    }
};
