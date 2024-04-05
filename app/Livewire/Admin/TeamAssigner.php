<?php

namespace App\Livewire\Admin;

use App\Modules\Leagues\Models\League;
use App\Modules\Teams\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TeamAssigner extends Component
{

    public int $selectedLeague;

    public array $teamOptions = [];
    public array $leaguesOptions = [];
    public array $currentlySelectedTeams = [];

    public Collection $leagueTeams;


    public function mount(Collection $selectedTeams = null, int $selectedLeague = null)
    {
        $leagues = League::all();

        foreach ($leagues as $league) {
            $this->leaguesOptions[$league->id] = $league->name . " - " . $league->sport->name;
        }

        if(is_null($selectedLeague)) {
            $this->selectedLeague = $leagues->first()->id;
        } else {
            $this->selectedLeague = $selectedLeague;
        }


        $teams = Team::query()
            ->where('league_id', '=', $this->selectedLeague)
            ->get();

        foreach ($teams as $team) {
            $this->teamOptions[$team->id] = $team->name . " - " . $team->league->name;
        }


        $this->leagueTeams = $selectedTeams;

    }

    public function render()
    {
        return view('livewire.admin.team-assigner');
    }

    public function updated($property) {
        if($property === 'selectedLeague') {
            $this->reset('teamOptions');
            $teams = Team::query()
                ->where('league_id', '=', $this->selectedLeague)
                ->get();

            foreach ($teams as $team) {
                $this->teamOptions[$team->id] = $team->name . " - " . $team->league->name;
            }
        }
    }


}
