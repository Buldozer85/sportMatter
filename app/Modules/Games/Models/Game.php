<?php

namespace App\Modules\Games\Models;

use App\Modules\Leagues\Models\League;
use App\Modules\Referees\Models\Referee;
use App\Modules\Teams\Models\Team;
use App\Modules\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Carbon $date_of_match
 * @property int $lap
 * @property string $parameters
 * @property int $supervisor_id
 * @property int $away_team_id
 * @property int $home_team_id
 * @property int $season_id
 * @property int $league_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Game extends Model
{
    protected $table = 'matches';

    protected $casts = [
        'date_of_match' => 'datetime',
        'parameters' => 'json'
    ];

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function referees(): BelongsToMany
    {
        return $this->belongsToMany(Referee::class, 'match_has_referees');
    }

    public function getMeta(string $key) {
        return json_decode($this->parameters)[$key];
    }
}
