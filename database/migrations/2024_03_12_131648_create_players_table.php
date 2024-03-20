<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->dateTime('birthdate');

            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('team_id');

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('team_id')->references('id')->on('teams');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
