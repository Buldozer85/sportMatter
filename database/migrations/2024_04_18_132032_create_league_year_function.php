<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('
            CREATE FUNCTION `season_year_function`(season int) RETURNS varchar(20) DETERMINISTIC
            BEGIN
                DECLARE year1 varchar(4);
                DECLARE year2 varchar(4);

                SELECT YEAR(yearStart) INTO year1 FROM seasons WHERE id = season;
                SELECT YEAR(yearEnd) INTO year2 FROM seasons WHERE id = season;

                IF(year1 = year2) THEN
                        RETURN year1;
                    ELSE
                        RETURN CONCAT(year1, "/", year2);
                END IF;
            END
        ');
    }

    public function down(): void
    {
        DB::statement('DROP FUNCTION IF EXISTS season_year_function');
    }
};
