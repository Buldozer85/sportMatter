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

    public bool $hasNextMatches = true;

    public int $sport;

    public function mount(int $sport, Carbon $date = null) {
        $this->sport = $sport;

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
            })
            ->where('sport_id', '=', $this->sport)
            ->get();

        $nextDatesLeagues =  League::query()
            ->whereHas('matches', function (Builder $query) {
                $query->whereDate('date_of_match', '>',  $this->date->format('Y-m-d'));
            })
            ->where('sport_id', '=', $this->sport)
            ->first();


        $this->hasNextMatches = !is_null($nextDatesLeagues);

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
                    $query->whereDate('date_of_match', '=',  $this->date->format('Y-m-d'));
                })->where('sport_id', '=', $this->sport)->get();

            $nextDatesLeagues =  League::query()
                ->whereHas('matches', function (Builder $query) {
                    $query->whereDate('date_of_match', '>',  $this->date->format('Y-m-d'));
                })->where('sport_id', '=', $this->sport)->first();



            $this->hasNextMatches = !is_null($nextDatesLeagues) && !is_null($nextDatesLeagues->matches()->whereDate('date_of_match', '>', $this->date->format('Y-m-d'))->orderBy('date_of_match')->first());

        }
    }

    public function move() {
        $nextDatesLeagues =  League::query()
            ->whereHas('matches', function (Builder $query) {
                $query->whereDate('date_of_match', '>',  $this->date->format('Y-m-d'));
            })->where('sport_id', '=', $this->sport)->first();

        if(is_null($nextDatesLeagues)) {
            $this->hasNextMatches = false;
            return;
        }


        $this->date = $nextDatesLeagues->matches()->whereDate('date_of_match', '>', $this->date->format('Y-m-d'))->orderBy('date_of_match')->first()->date_of_match;
        $this->inputDate = $this->date->format('Y-m-d');

        $this->leaguesWithMatches = League::query()->whereHas('matches', function (Builder $query) {
            $query->whereDate('date_of_match', '>',  $this->date->format('Y-m-d'));
        })->where('sport_id', '=', $this->sport)->get();
    }
}
