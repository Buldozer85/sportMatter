<?php

declare(strict_types=1);

namespace App\Modules\Games\Controllers;

use App\enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGameRequest;
use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use App\Modules\Referees\Models\Referee;
use App\Modules\Users\Models\User;
use http\Env\Response;

final class GamesController extends Controller
{
    public function create(CreateGameRequest $request)
    {
        $game = new Game();
        $game->date_of_match = $request->get('date_of_match');
        $game->lap = $request->get('lap');
        $game->away_team_id = $request->get('away_team');
        $game->home_team_id = $request->get('home_team');
        $game->league_id = $request->get('league');
        $game->season_id = $request->get('seasons');

        foreach ($request->get('referees') as $referee) {
            $game->referees()->attach($referee);
        }

        $league = League::query()->find($game->league_id);

        switch ($league->sport->name) {
            case 'Šipky': {
                $params = [
                    'count_of_sets_first_player' => $request->get('count_of_sets_first_player'),
                    'count_of_legs_first_player' => $request->get('count_of_legs_first_player'),
                    'average_player_one' => $request->get('average_player_one'),
                    'count_of_sets_second_player' => $request->get('count_of_sets_second_player'),
                    'count_of_legs_second_player' => $request->get('count_of_legs_second_player'),
                    'average_player_two' => $request->get('average_player_two')

                ];
                $game->parameters = json_encode($params);
                break;
            }
            case 'Fotbal': {

            }
            case 'Hokej': {

            }
        }


        $game->save();

        return redirect()->route('admin.games.show-update', $game->id);
    }

    public function showCreate()
    {
        return view('admin.games.new');
    }

    public function showUpdate(League $league)
    {
        $sports = Sport::all();
        $countries = Country::all();

        $sportOptions = [];

        foreach ($sports as $sport) {
            $sportOptions[$sport->id] = $sport->name;
        }

        $countryOptions = [];

        foreach ($countries as $country) {
            $countryOptions[$country->id] = $country->name;
        }

        return view('admin.gemes.update')->with(['league' => $league, 'sportsOptions' => $sportOptions, 'countryOptions' => $countryOptions]);
    }

    public function update(Game $game, LeagueRequest $request)
    {
        $game->save();

        return redirect()->route('admin.games.show-update', $game->id);
    }
}
