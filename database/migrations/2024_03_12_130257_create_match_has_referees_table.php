<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('match_has_referees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_match');
            $table->unsignedBigInteger('id_referee');

            $table->foreign('id_match')->references('id')->on('matches');
            $table->foreign('id_referee')->references('id')->on('referees');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_has_referees');
    }
};
