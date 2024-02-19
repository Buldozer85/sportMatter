<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Models;

use App\Helpers\Enums\CastTypeEnum;
use App\Helpers\Enums\SportTypeEnum;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

    public const ATTR_ASSOCIATION_ID = 'association_id';

    public const ATTR_SPORT = 'sport';

    public const ATTR_TYPE_ID = 'type_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_NAME,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_NAME => CastTypeEnum::STRING,
        self::ATTR_ASSOCIATION_ID => CastTypeEnum::INTEGER,
        self::ATTR_SPORT => SportTypeEnum::class,
        self::ATTR_TYPE_ID => CastTypeEnum::INTEGER,
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttributeValue(self::ATTR_ID);
    }
}
