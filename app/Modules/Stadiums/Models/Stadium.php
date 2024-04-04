<?php

declare(strict_types=1);

namespace App\Modules\Stadiums\Models;

use App\Services\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Model;

final class Stadium extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_CAPACITY = 'capacity';

    public const ATTR_NAME = 'name';

    public const ATTR_CREATED_AT = Model::CREATED_AT;

    public const ATTR_UPDATED_AT = Model::UPDATED_AT;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_CAPACITY,
        self::ATTR_NAME,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_CAPACITY => CastTypeEnum::DATETIME,
        self::ATTR_NAME => CastTypeEnum::DATETIME,
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
