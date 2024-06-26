<?php

declare(strict_types=1);

namespace App\Modules\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\enums\Role;
use App\Modules\Games\Models\Game;
use App\Services\Enums\CastTypeEnum;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property Role $access
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $full_name
 * @property string $banner_credentials
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ATTR_ID = 'id';

    public const ATTR_FIRST_NAME = 'first_name';

    public const ATTR_LAST_NAME = 'last_name';

    public const ATTR_EMAIL = 'email';

    public const ATTR_PASSWORD = 'password';

    public const ATTR_ACCESS = 'access';

    public const ATTR_REMEMBER_TOKEN = 'remember_token';

    public const ATTR_EMAIL_VERIFIED_AT = 'email_verified_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_FIRST_NAME,
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
        self::ATTR_FIRST_NAME => CastTypeEnum::STRING,
        self::ATTR_LAST_NAME => CastTypeEnum::STRING,
        self::ATTR_EMAIL => CastTypeEnum::STRING,
        self::ATTR_EMAIL_VERIFIED_AT => CastTypeEnum::DATETIME,
        self::ATTR_PASSWORD => CastTypeEnum::HASHED,
        self::ATTR_ACCESS => CastTypeEnum::ROLE,
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttributeValue(self::ATTR_ID);
    }

    public function getFirstName(): string
    {
        return $this->getAttributeValue(self::ATTR_FIRST_NAME);
    }

    public function getLastName(): string
    {
        return $this->getAttributeValue(self::ATTR_LAST_NAME);
    }

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn() => $this->getFirstName() . ' ' . $this->getLastName());
    }

    public function bannerCredentials(): Attribute
    {
        return Attribute::make(get: fn() => Str::charAt($this->getFirstName(), 0) . Str::charAt($this->getLastName(), 0));
    }

    public function isSuperAdmin(): Attribute
    {
        return Attribute::make(get: fn() => $this->access->value === Role::SUPER_ADMINISTRATOR->value);
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(get: fn() => !in_array($this->access, [ROLE::USER, ROLE::EDITOR]));
    }

    public function getAccess()
    {
        return $this->getAttributeValue(self::ATTR_ACCESS);
    }

    public function favoriteMatches(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'favorite_matches', 'user_id', 'match_id');
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
