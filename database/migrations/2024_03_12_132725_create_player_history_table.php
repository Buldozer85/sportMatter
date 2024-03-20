<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('player_history', function (Blueprint $table) {
            $table->id();

            $table->dateTime('date_of_transfer');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_id');

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('team_id')->references('id')->on('teams');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_history');
    }
};
