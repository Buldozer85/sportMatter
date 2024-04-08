<?php

namespace App\Livewire\App;

use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class MatchesByDay extends Component
{
    public Carbon $date;

    public string $inputDate;

    public Collection $leaguesWithMatches;

    public function mount(Carbon $date = null) {
        if(is_null($date)) {
            $this->date = Carbon::now();
            $this->inputDate = $this->date->format('Y-m-d');
        } else {
            $this->date = $date;
            $this->inputDate = $date->format('Y-m-d');
        }

        $this->leaguesWithMatches = League::query()
            ->whereHas('matches', function (Builder $query) {
                $query->where('date_of_match', '=',  $this->date->format('Y-m-d'));
            })->get();
    }

    public function render()
    {
        return view('livewire.app.matches-by-day');
    }

    public function updated(string $property)
    {
        if($property === 'inputDate') {
            $this->date = Carbon::parse($this->inputDate);

            $this->leaguesWithMatches = League::query()
                ->whereHas('matches', function (Builder $query){
                    $query->where('date_of_match', '=',  $this->date->format('Y-m-d'));
                })->get();
        }
    }
}
