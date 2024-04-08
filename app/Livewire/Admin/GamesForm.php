<?php

namespace App\Livewire\Admin;

use App\enums\Role;
use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use App\Modules\Referees\Models\Referee;
use App\Modules\Seasons\Models\Season;
use App\Modules\Teams\Models\Team;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class GamesForm extends Component
{
    public int $selectedLeague;

    public array $homeTeamOptions = [];

    public array $awayTeamOptions = [];

    public array $leaguesOptions = [];

    public array $seasonsOptions = [];

    public ?int $selectedHome;
    public ?int $selectedAway;

    public string $sportName;

    public Collection $leagueTeams;

    public array $refereesOptions = [];

    private Collection $leagues;

    public ?Game $game;

    public function mount(Game $game = null)
    {
        $this->game = $game;

        $leagues = League::query()
            ->with('sport')
            ->get();

        $this->leagues = $leagues;

        foreach ($leagues as $league) {
            $this->leaguesOptions[$league->id] = $league->name . " - " . $league->sport->name;
        }

        $leagueSport = $game->league?->sport;



        if (is_null($this->game->id)) {

            $this->selectedLeague = old('league') ?? $leagues->first()->id;

            $leagueSport = $leagues->where('id', '=', $this->selectedLeague)->first()->sport;

            $teams = Team::query()
                ->where('league_id', '=', $this->selectedLeague)
                ->get();

            $this->sportName = $leagueSport->name;

            $awayTeams = $teams->whereNotIn('id', $teams->first()?->id);

        } else {
            $this->selectedLeague = $game->league->id;
            $this->sportName = $game->league->sport->name;
            $teams = Team::query()
                ->where('league_id', '=', $this->selectedLeague)
                ->get();
            $awayTeams = $teams->where('id', '!=', $game->home_team_id);

        }



        foreach ($teams->where('id', '!=', $awayTeams->first()?->id) as $team) {
            $this->homeTeamOptions[$team->id] = $team->name . " - " . $team->league->name;
        }

        $this->selectedHome = $game->home_team_id ?? array_key_first($this->homeTeamOptions);


        foreach ($awayTeams as $team) {
            $this->awayTeamOptions[$team->id] = $team->name . " - " . $team->league->name;
        }

        $this->selectedAway = $game->away_team_id ?? array_key_first($this->awayTeamOptions);


        $referees = Referee::query()
            ->where('sport_id', '=', $leagueSport->id)
            ->get();

        foreach ($referees as $referee) {
            $this->refereesOptions[$referee->id] = $referee->full_name;
        }

        $seasons = Season::query()
            ->where('league_id', '=', $this->selectedLeague)
            ->get();

        foreach ($seasons as $season) {
            $this->seasonsOptions[$season->id] = $season->league->name . " " . $season->yearStart->format('Y') . '/'. $season->yearEnd->format('Y');
        }
    }


    public function updated($property)
    {
        if ($property === 'selectedLeague') {
            $this->reset('homeTeamOptions');
            $this->reset('awayTeamOptions');
            $this->reset('sportName');
            $this->reset('refereesOptions');

            $teams = Team::query()
                ->where('league_id', '=', $this->selectedLeague)
                ->with('league')
                ->get();

            $awayTeams = $teams->where('id', '!=', $teams->first()?->id);


            foreach ($teams->where('id', '!=', $awayTeams->first()?->id) as $team) {
                $this->homeTeamOptions[$team->id] = $team->name . " - " . $team->league->name;
            }
            $this->selectedHome = array_key_first($this->homeTeamOptions);

            foreach ($awayTeams as $team) {
                $this->awayTeamOptions[$team->id] = $team->name . " - " . $team->league->name;
            }

            $this->selectedAway = array_key_first($this->awayTeamOptions);

            $leagues = League::query()
                ->with('sport')
                ->get();

            $leagueSport = $leagues->where('id', '=', $this->selectedLeague)->first()->sport;

            $this->sportName = $leagueSport->name;

            $referees = Referee::query()
                ->where('sport_id', '=', $leagueSport->id)
                ->get();

            foreach ($referees as $referee) {
                $this->refereesOptions[$referee->id] = $referee->full_name;
            }

            $seasons = Season::query()
                ->where('league_id', '=', $this->selectedLeague)
                ->get();

            foreach ($seasons as $season) {
                $this->seasonsOptions[$season->id] = $season->league->name . " " . $season->yearStart->format('Y') . '/'. $season->yearEnd->format('Y');
            }

            return;
        }

        if ($property === 'selectedHome' || $property === 'selectedAway') {
            $teams = Team::query()
                ->where('league_id', '=', $this->selectedLeague)
                ->get();

            foreach ($teams->where('id', '!=', $this->selectedAway)->all() as $team) {
                $this->homeTeamOptions[$team->id] = $team->name . " - " . $team->league->name;
            }

            foreach ($teams->where('id', '!=', $this->selectedHome) as $team) {
                $this->awayTeamOptions[$team->id] = $team->name . " - " . $team->league->name;
            }
        }
    }

    public function render()
    {
        $supervisors = User::query()
            ->whereNot('access', Role::USER->value)
            ->get();

        $supervisorOptions = [];

        foreach ($supervisors as $supervisor) {
            $supervisorOptions[$supervisor->id] = $supervisor->full_name;
        }

        return view('livewire.admin.games-form')->with(['supervisorOptions' => $supervisorOptions]);
    }
}
