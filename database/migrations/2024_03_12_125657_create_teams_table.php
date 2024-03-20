<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('short_name', 10);
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('stadium_id');

            $table->foreign('league_id')->references('id')->on('leagues');
            $table->foreign('stadium_id')->references('id')->on('stadiums');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
