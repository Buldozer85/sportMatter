<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Models;


use App\Helpers\Enums\SportTypeEnum;
use App\Modules\Countries\Models\Country;
use App\Modules\Games\Models\Game;
use App\Modules\Sports\Models\Sport;
use App\Services\Enums\CastTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $association
 * @property string $name
 * @property int $country_id
 * @property int $sport_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class League extends Model
{
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

    public const ATTR_ASSOCIATION_ID = 'association_id';

    public const ATTR_SPORT = 'sport';

    public const ATTR_TYPE_ID = 'type_id';


    public function getId(): int
    {
        return $this->getAttributeValue(self::ATTR_ID);
    }

    /**
     * @param array<array-key, mixed> $data
     * @return void
     */
    public function compactFill(array $data): void
    {
        $this->setName($data[self::ATTR_NAME]);
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->setAttribute(self::ATTR_NAME, $name);
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(Game::class, 'league_id');
    }
}
