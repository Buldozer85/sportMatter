<?php

namespace App\Modules\Games\Models;

use App\enums\FootballActions;
use App\enums\FootballParameters;
use App\enums\HockeyParameters;
use App\Modules\Leagues\Models\League;
use App\Modules\Referees\Models\Referee;
use App\Modules\Teams\Models\Team;
use App\Modules\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        return $this->belongsToMany(Referee::class, 'match_has_referees', 'id_match', 'id_referee');
    }

    public function getMeta(string $key): string | null | array {
        $decoded = json_decode($this->parameters, true);

        if(is_null($decoded)) {
            return null;
        }

        if(!array_key_exists($key, $decoded)) {
            return null;
        }

        return $decoded[$key];
    }

    public function homeActionsCount(): Attribute
    {
        return Attribute::make(get: function () {
            $actions = $this->getMeta(FootballParameters::ACTIONS_HOME->value);

            if (is_null($actions)) {
                return 0;
            }

            $count = 0;

            foreach ($actions as $action) {
                $count += count($action);
            }

            return $count;
        });
    }

    public function awayActionsCount(): Attribute
    {
        return Attribute::make(get: function () {
            $actions = $this->getMeta(FootballParameters::ACTIONS_AWAY->value);

            if (is_null($actions)) {
                return 0;
            }

            $count = 0;

            foreach ($actions as $action) {
                $count += count($action);
            }

            return $count;
        });
    }


    public function hockeyHomeActionsCount(): Attribute
    {
        return Attribute::make(get: function () {
            $actions = $this->getMeta(HockeyParameters::HOCKEY_ACTIONS_HOME->value);

            if (is_null($actions)) {
                return 0;
            }

            $count = 0;

            foreach ($actions as $action) {
                $count += count($action);
            }

            return $count;
        });
    }

    public function hockeyAwayActionsCount(): Attribute
    {
        return Attribute::make(get: function () {
            $actions = $this->getMeta(HockeyParameters::HOCKEY_ACTIONS_AWAY->value);

            if (is_null($actions)) {
                return 0;
            }

            $count = 0;

            foreach ($actions as $action) {
                $count += count($action);
            }

            return $count;
        });
    }

    public function score(): Attribute
    {
        return Attribute::make(function () {
            $sport = match ($this->league->sport->name) {
                'Hokej' => 'hockey_',
                default => ''
            };

           $homeTeam = $this->getMeta($sport . 'count_of_goals_home_team');
           $awayTeam = $this->getMeta($sport . 'count_of_goals_away_team');

           return ($homeTeam ?? '-') . ':' . ($awayTeam ?? '-');
        });
    }
}
