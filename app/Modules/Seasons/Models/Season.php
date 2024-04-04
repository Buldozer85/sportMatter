<?php

declare(strict_types=1);

namespace App\Modules\Seasons\Models;

use App\Services\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Model;

final class Season extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_YEAR_START = 'year_start';

    public const ATTR_YEAR_END = 'year_end';

    public const ATTR_LEAGUE_ID = 'league_id';

    public const ATTR_CREATED_AT = Model::CREATED_AT;

    public const ATTR_UPDATED_AT = Model::UPDATED_AT;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_YEAR_START,
        self::ATTR_YEAR_END,
        self::ATTR_LEAGUE_ID,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_YEAR_START => CastTypeEnum::DATETIME,
        self::ATTR_YEAR_END => CastTypeEnum::DATETIME,
        self::ATTR_LEAGUE_ID => CastTypeEnum::INTEGER,
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
