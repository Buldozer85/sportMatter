<?php

namespace App\Modules\Games\Models;

use App\Services\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_DATE_OF_MATCH = 'date_of_match';

    public const ATTR_LAP = 'lap';

    public const ATTR_PARAMETERS = 'parameters';

    public const ATTR_SUPERVISOR_ID = 'supervisor_id';

    public const ATTR_AWAY_TEAM_ID = 'away_team_id';

    public const ATTR_HOME_TEAM_ID = 'home_team_id';

    public const ATTR_LEAGUE_ID = 'league_id';

    public const ATTR_CREATED_AT = Model::CREATED_AT;

    public const ATTR_UPDATED_AT = Model::UPDATED_AT;

    protected $table = 'matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_DATE_OF_MATCH,
        self::ATTR_LAP,
        self::ATTR_PARAMETERS,
        self::ATTR_SUPERVISOR_ID,
        self::ATTR_AWAY_TEAM_ID,
        self::ATTR_HOME_TEAM_ID,
        self::ATTR_LEAGUE_ID,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_DATE_OF_MATCH => CastTypeEnum::DATETIME,
        self::ATTR_LAP => CastTypeEnum::INTEGER,
        self::ATTR_PARAMETERS => CastTypeEnum::JSON,
        self::ATTR_SUPERVISOR_ID => CastTypeEnum::INTEGER,
        self::ATTR_AWAY_TEAM_ID => CastTypeEnum::INTEGER,
        self::ATTR_HOME_TEAM_ID => CastTypeEnum::INTEGER,
        self::ATTR_LEAGUE_ID => CastTypeEnum::INTEGER
    ];

    /**
     * @param array<array-key, mixed> $data
     * @return void
     */
    public function compactFill(array $data): void
    {
        return;
    }
}
