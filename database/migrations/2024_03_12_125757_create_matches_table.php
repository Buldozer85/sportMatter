<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_of_match');
            $table->integer('lap');
            $table->json('parameters');
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('league_id');

            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->foreign('away_team_id')->references('id')->on('teams');
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('league_id')->references('id')->on('leagues');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
