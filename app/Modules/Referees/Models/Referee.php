<?php

declare(strict_types=1);

namespace App\Modules\Referees\Models;

use App\Services\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_FIRST_NAME = 'first_name';


    public const ATTR_LAST_NAME = 'last_name';

    public const ATTR_SPORT_ID = 'sport_id';

    public const ATTR_CREATED_AT = Model::CREATED_AT;

    public const ATTR_UPDATED_AT = Model::UPDATED_AT;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_FIRST_NAME,
        self::ATTR_LAST_NAME,
        self::ATTR_SPORT_ID
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_FIRST_NAME => CastTypeEnum::STRING,
        self::ATTR_LAST_NAME => CastTypeEnum::STRING,
        self::ATTR_SPORT_ID => CastTypeEnum::INTEGER,
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
