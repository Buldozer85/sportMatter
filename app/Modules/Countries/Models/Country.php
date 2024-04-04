<?php

declare(strict_types=1);

namespace App\Modules\Countries\Models;

use App\Services\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Model;

final class Country extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

    public const ATTR_SHORT_NAME = 'short_name';

    public const ATTR_CREATED_AT = Model::CREATED_AT;

    public const ATTR_UPDATED_AT = Model::UPDATED_AT;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_SHORT_NAME
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_NAME => CastTypeEnum::STRING,
        self::ATTR_SHORT_NAME => CastTypeEnum::STRING,
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
