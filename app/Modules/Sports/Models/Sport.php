<?php

declare(strict_types=1);

namespace App\Modules\Sports\Models;

use App\Helpers\Enums\SportTypeEnum;
use App\Services\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Model;

final class Sport extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

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
    ];
}
