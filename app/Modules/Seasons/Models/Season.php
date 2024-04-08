<?php

declare(strict_types=1);

namespace App\Modules\Seasons\Models;

use App\Helpers\Enums\SportTypeEnum;
use App\Modules\Leagues\Models\League;
use App\Modules\Teams\Models\Team;
use App\Services\Enums\CastTypeEnum;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Carbon $yearStart
 * @property Carbon $yearEnd
 * @property int $league_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property boolean $is_active
 * @property string $season_years
 */
final class Season extends Model
{
    public function league(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'season_has_teams');
    }

    protected $casts = [
        'yearEnd' => 'date',
        'yearStart' => 'date'
    ];

    public function seasonYears(): Attribute
    {
        if($this->yearEnd->format('Y') === $this->yearStart->format('Y')) {
            return Attribute::make(get: fn() => $this->yearStart->format('Y'));
        }
        return Attribute::make(get: fn() => $this->yearStart->format('Y'). '/' . $this->yearEnd);
    }
}
