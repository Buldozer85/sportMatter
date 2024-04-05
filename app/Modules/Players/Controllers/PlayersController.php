<?php

declare(strict_types=1);

namespace App\Modules\Players\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Modules\Countries\Models\Country;
use App\Modules\Players\Models\Player;
use App\Modules\Teams\Models\Team;
use http\Env\Response;

final class PlayersController extends Controller
{
    public function create(PlayerRequest $request)
    {
        $player = new Player();
        $player->first_name = $request->get('first_name');
        $player->last_name = $request->get('last_name');
        $player->team_id = $request->get('team');
        $player->country_id = $request->get('country');
        $player->birthdate = $request->get('birthdate');

        $player->save();

        return redirect()->route('admin.players.show-update', $player->id);
    }

    public function showCreate()
    {
        $teams = Team::all();
        $countries = Country::all();

        $teamOptions = [];

        foreach ($teams as $team) {
            $teamOptions[$team->id] = $team->name . " - " . $team->league->sport->name;
        }

        $countryOptions = [];

        foreach ($countries as $country) {
            $countryOptions[$country->id] = $country->name;
        }

        return view('admin.players.new')->with(['teamOptions' => $teamOptions, 'countryOptions' => $countryOptions]);
    }

    public function showUpdate(Player $player)
    {
        $teams = Team::all();
        $countries = Country::all();

        $teamOptions = [];

        foreach ($teams as $team) {
            $teamOptions[$team->id] = $team->name . " - " . $team->league->sport->name;
        }

        $countryOptions = [];

        foreach ($countries as $country) {
            $countryOptions[$country->id] = $country->name;
        }


        return view('admin.players.update')->with(['player' => $player, 'teamOptions' => $teamOptions, 'countryOptions' => $countryOptions]);
    }

    public function update(Player $player, PlayerRequest $request)
    {
        $player->first_name = $request->get('first_name');
        $player->last_name = $request->get('last_name');
        $player->team_id = $request->get('team');
        $player->country_id = $request->get('country');
        $player->birthdate = $request->get('birthdate');

        $player->save();

        return redirect()->route('admin.players.show-update', $player->id);
    }
}
