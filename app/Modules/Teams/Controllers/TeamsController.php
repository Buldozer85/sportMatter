<?php

namespace App\Modules\Teams\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Modules\Countries\Models\Country;
use App\Modules\Leagues\Models\League;
use App\Modules\Stadiums\Models\Stadium;
use App\Modules\Teams\Models\Team;

class TeamsController extends Controller
{
    public function create(CreateTeamRequest $request)
    {
       $team = new Team();
       $team->name = $request->get('name');
       $team->short_name = $request->get('short_name');
       $team->league_id = $request->get('league');
       $team->stadium_id = $request->get('stadium');

        $team->save();

       return redirect()->route('admin.teams.show-update', $team->id);
    }

    public function showCreate()
    {
        $leagues = League::all();
        $stadiums = Stadium::all();

        $leaguesOptions = [];

        foreach ($leagues as $league) {
            $leaguesOptions[$league->id] = $league->name . " - " . $league->sport->name;
        }

        $stadiumsOptions = [];

        foreach ($stadiums as $stadium) {
            $stadiumsOptions[$stadium->id] = $stadium->name;
        }
        return view('admin.teams.new')->with(['leagueOptions' => $leaguesOptions, 'stadiumOptions' => $stadiumsOptions]);
    }

    public function showUpdate(Team $team)
    {
        $leagues = League::all();
        $stadiums = Stadium::all();

        $leaguesOptions = [];

        foreach ($leagues as $league) {
            $leaguesOptions[$league->id] = $league->name . " - " . $league->sport->name;
        }

        $stadiumsOptions = [];

        foreach ($stadiums as $stadium) {
            $stadiumsOptions[$stadium->id] = $stadium->name;
        }

        return view('admin.teams.update')->with(['team' => $team, 'leagueOptions' => $leaguesOptions, 'stadiumOptions' => $stadiumsOptions]);
    }

    public function update(Team $team, UpdateTeamRequest $request)
    {
        $team->name = $request->get('name');
        $team->short_name = $request->get('short_name');

        $team->save();



        return redirect()->route('admin.teams.show-update', $team->id);
    }
}
