<?php

declare(strict_types=1);

namespace App\Modules\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\Enums\CastTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

    public const ATTR_EMAIL = 'email';

    public const ATTR_PASSWORD = 'password';

    public const ATTR_REMEMBER_TOKEN = 'remember_token';

    public const ATTR_EMAIL_VERIFIED_AT = 'email_verified_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_EMAIL,
        self::ATTR_PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::ATTR_PASSWORD,
        self::ATTR_REMEMBER_TOKEN,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::ATTR_NAME => CastTypeEnum::STRING,
        self::ATTR_EMAIL => CastTypeEnum::STRING,
        self::ATTR_EMAIL_VERIFIED_AT => CastTypeEnum::DATETIME,
        self::ATTR_PASSWORD => CastTypeEnum::HASHED,
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttributeValue(self::ATTR_ID);
    }
}
