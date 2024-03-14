<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $query = '
          CREATE PROCEDURE Register (IN `first_name` varchar(255), IN `last_name` varchar(255), IN `email` varchar(255), IN `password` varchar(255), IN `access` varchar(255))
          BEGIN
          INSERT INTO users (first_name, last_name, email, password, access) VALUES (first_name, last_name, email, password, access);
          END
        ';
        DB::unprepared($query);
    }

    public function down(): void
    {
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS Register;'
        );
    }
};
