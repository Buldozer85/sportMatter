<?php

declare(strict_types=1);

namespace App\Modules\Teams\Models;

use App\Modules\Leagues\Models\League;
use App\Modules\Seasons\Models\Season;
use App\Modules\Stadiums\Models\Stadium;
use Carbon\Carbon;
use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property int $league_id
 * @property int $stadium_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Team extends Model
{
    use HasFactory;
    public function stadium(): BelongsTo
    {
        return $this->belongsTo(Stadium::class);
    }

    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'season_has_teams');
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function getMatchesCountInSeason(int $season_id)
    {
        return $this->seasons->where('id', '=', $season_id)->count();
    }

    protected static function newFactory(): TeamFactory
    {
        return TeamFactory::new();
    }
}
