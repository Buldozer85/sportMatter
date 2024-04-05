<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('association');
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->unsignedBigInteger('sport_id');

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('sport_id')->references('id')->on('sports');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
