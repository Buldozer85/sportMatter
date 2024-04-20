<?php

declare(strict_types=1);

namespace App\Modules\Games\Controllers;

use App\enums\FootballActions;
use App\enums\HockeyActions;
use App\enums\MatchResults;
use App\enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use App\Modules\Referees\Models\Referee;
use App\Modules\Seasons\Models\Season;
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
        $game->season_id = $request->get('season');
        $game->supervisor_id = $request->get('supervisor');


        $league = League::query()->find($game->league_id);

        switch ($league->sport->name) {
            case 'Šipky': {
                $params = [
                    'count_of_sets_first_player' => $request->get('count_of_sets_first_player'),
                    'count_of_legs_first_player' => $request->get('count_of_legs_first_player'),
                    'average_player_one' => $request->get('average_player_one'),
                    'count_of_sets_second_player' => $request->get('count_of_sets_second_player'),
                    'count_of_legs_second_player' => $request->get('count_of_legs_second_player'),
                    'average_player_two' => $request->get('average_player_two'),
                    'darts_result_first_player' => $request->get('darts_result_first_player'),
                    'darts_result_second_player' => $request->get('darts_result_second_player')
                ];

                $season = Season::query()->find($game->season_id);

                $homePoints = MatchResults::from(intval($request->get('darts_result_first_player')));

                $prePoints =  $season->teams->where('id', '=', $game->home_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->home_team_id, ['points' => $prePoints + $homePoints->points()]);

                $awayPoints = MatchResults::from(intval($request->get('darts_result_second_player')));

                $prePoints =  $season->teams->where('id', '=', $game->away_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->away_team_id, ['points' => $prePoints + $awayPoints->points()]);

                $game->parameters = json_encode($params);
                break;
            }
            case 'Fotbal': {
                $params = [
                    'count_of_goals_home_team' => $request->get('count_of_goals_home_team'),
                    'holding_the_ball_home_team' => $request->get('holding_the_ball_home_team'),
                    'number_of_shots_on_goal_home_team' => $request->get('number_of_shots_on_goal_home_team'),
                    'number_of_shots_home_team' => $request->get('number_of_shots_home_team'),
                    'number_of_corner_home_team' => $request->get('number_of_corner_home_team'),
                    'number_of_offsides_home_team' => $request->get('number_of_offsides_home_team'),
                    'number_of_fouls_home_team' => $request->get('number_of_fouls_home_team'),
                    'number_of_red_cards_home_team' => $request->get('number_of_red_cards_home_team'),
                    'number_of_yellow_cards_home_team' => $request->get('number_of_yellow_cards_home_team'),
                    'count_of_goals_away_team' => $request->get('count_of_goals_away_team'),
                    'holding_the_ball_away_team' => $request->get('holding_the_ball_away_team'),
                    'number_of_shots_on_goal_away_team' => $request->get('number_of_shots_on_goal_away_team'),
                    'number_of_shots_away_team' => $request->get('number_of_shots_away_team'),
                    'number_of_corner_away_team' => $request->get('number_of_corner_away_team'),
                    'number_of_offsides_away_team' => $request->get('number_of_offsides_away_team'),
                    'number_of_fouls_away_team' => $request->get('number_of_fouls_away_team'),
                    'number_of_red_cards_away_team' => $request->get('number_of_red_cards_away_team'),
                    'number_of_yellow_cards_away_team' => $request->get('number_of_yellow_cards_away_team'),
                    'football_result_away_team' => $request->get('football_result_away_team'),
                    'football_result_home_team' => $request->get('football_result_home_team')
                ];

                $season = Season::query()->find($game->season_id);

                $homePoints = MatchResults::from(intval($request->get('football_result_home_team')));

                $prePoints =  $season->teams->where('id', '=', $game->home_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->home_team_id, ['points' => $prePoints + $homePoints->points()]);

                $awayPoints = MatchResults::from(intval($request->get('football_result_away_team')));

                $prePoints =  $season->teams->where('id', '=', $game->away_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->away_team_id, ['points' => $prePoints + $awayPoints->points()]);



                $homePlayersWithAction = $request->get('players_home');
                $homeMinutesActions = $request->get('minutes_home');
                $homeActions = $request->get('actions_home');

                $params['actions_home'] = [];

                foreach ($homePlayersWithAction as $index => $homePlayer) {
                    $params['actions_home'][$homeMinutesActions[$index]][] = [
                        'player' => $homePlayer,
                        'action' => FootballActions::from(intval($homeActions[$index]))->value,
                        'type' => 'home'
                    ];
                }
                ksort($params['actions_home']);

                $awayPlayersWithAction = $request->get('players_away');
                $awayMinutesActions = $request->get('minutes_away');
                $awayActions = $request->get('actions_away');

                $params['actions_away'] = [];

                foreach ($awayPlayersWithAction as $index => $awayPlayer) {
                    $params['actions_away'][$awayMinutesActions[$index]][] = [
                        'player' => $awayPlayer,
                        'action' => FootballActions::from(intval($awayActions[$index]))->value,
                        'type' => 'away'
                    ];
                }

                ksort($params['actions_away']);

                $params['actions'] = array_replace($params['actions_home'], $params['actions_away']);

                ksort($params['actions']);

                $game->parameters = json_encode($params);
                break;
            }
            case 'Hokej': {
                $params = [
                    'hockey_count_of_goals_home_team' => $request->get('hockey_count_of_goals_home_team'),
                    'hockey_shooting_success_home_team' => $request->get('hockey_shooting_success_home_team'),
                    'hockey_number_of_shots_on_goal_home_team' => $request->get('hockey_number_of_shots_on_goal_home_team'),
                    'hockey_number_of_shots_home_team' => $request->get('hockey_number_of_shots_home_team'),
                    'hockey_number_of_exclusion_home_team' => $request->get('hockey_number_of_exclusion_home_team'),
                    'hockey_number_of_goalkeeper_interventions_home_team' => $request->get('hockey_number_of_goalkeeper_interventions_home_team'),
                    'hockey_number_of_blocked_shots_home_team' => $request->get('hockey_number_of_blocked_shots_home_team'),
                    'hockey_number_of_power_play_goals_home_team' => $request->get('hockey_number_of_power_play_goals_home_team'),
                    'hockey_number_of_buly_won_home_team' => $request->get('hockey_number_of_buly_won_home_team'),
                    'hockey_count_of_goals_away_team' => $request->get('hockey_count_of_goals_away_team'),
                    'hockey_shooting_success_away_team' => $request->get('hockey_shooting_success_away_team'),
                    'hockey_number_of_shots_on_goal_away_team' => $request->get('hockey_number_of_shots_on_goal_away_team'),
                    'hockey_number_of_shots_away_team' => $request->get('hockey_number_of_shots_away_team'),
                    'hockey_number_of_exclusion_away_team' => $request->get('hockey_number_of_exclusion_away_team'),
                    'hockey_number_of_goalkeeper_interventions_away_team' => $request->get('hockey_number_of_goalkeeper_interventions_away_team'),
                    'hockey_number_of_blocked_shots_away_team' => $request->get('hockey_number_of_blocked_shots_away_team'),
                    'hockey_number_of_power_play_goals_away_team' => $request->get('hockey_number_of_power_play_goals_away_team'),
                    'hockey_number_of_buly_won_away_team' => $request->get('hockey_number_of_buly_won_away_team'),
                    'football_result_away_team' => $request->get('hockey_result_away_team'),
                    'football_result_home_team' => $request->get('hockey_result_home_team')
                ];

                $season = Season::query()->find($game->season_id);

                $homePoints = MatchResults::from(intval($request->get('hockey_result_home_team')));

                $prePoints =  $season->teams->where('id', '=', $game->home_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->home_team_id, ['points' => $prePoints + $homePoints->points()]);

                $awayPoints = MatchResults::from(intval($request->get('hockey_result_away_team')));

                $prePoints =  $season->teams->where('id', '=', $game->away_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->away_team_id, ['points' => $prePoints + $awayPoints->points()]);

                $homePlayersWithAction = $request->get('hockey_players_home');
                $homeMinutesActions = $request->get('hockey_minutes_home');
                $homeActions = $request->get('hockey_actions_home');

                $params['hockey_actions_home'] = [];

                foreach ($homePlayersWithAction as $index => $homePlayer) {
                    $params['hockey_actions_home'][$homeMinutesActions[$index]][] = [
                        'player' => $homePlayer,
                        'action' => HockeyActions::from(intval($homeActions[$index]))->value,
                        'type' => 'home'
                    ];
                }

                ksort($params['hockey_actions_home']);

                $awayPlayersWithAction = $request->get('hockey_players_away');
                $awayMinutesActions = $request->get('hockey_minutes_away');
                $awayActions = $request->get('hockey_actions_away');

                $params['hockey_actions_away'] = [];

                foreach ($awayPlayersWithAction as $index => $awayPlayer) {
                    $params['hockey_actions_away'][$awayMinutesActions[$index]][] = [
                        'player' => $awayPlayer,
                        'action' => HockeyActions::from(intval($awayActions[$index]))->value,
                        'type' => 'away'
                    ];
                }

                ksort($params['hockey_actions_away']);

                $params['actions'] = array_replace($params['hockey_actions_home'], $params['hockey_actions_away']);

                ksort($params['actions']);

                $game->parameters = json_encode($params);
                break;
            }
        }


        $game->save();
        foreach ($request->get('referees') as $referee) {
            $game->referees()->attach($referee);
        }


        return redirect()->route('admin.games.show-update', $game->id);
    }

    public function showCreate()
    {
        return view('admin.games.new');
    }

    public function showUpdate(Game $game)
    {
        return view('admin.games.update')->with(['game' => $game]);
    }

    public function update(Game $game, UpdateGameRequest $request)
    {
        $game->date_of_match = $request->get('date_of_match');
        $game->lap = $request->get('lap');
        $game->away_team_id = $request->get('away_team');
        $game->home_team_id = $request->get('home_team');
        $game->league_id = $request->get('league');
        $game->season_id = $request->get('season');
        $game->supervisor_id = $request->get('supervisor');


        $league = League::query()->find($game->league_id);

        switch ($league->sport->name) {
            case 'Šipky': {
                $params = [
                    'count_of_sets_first_player' => $request->get('count_of_sets_first_player'),
                    'count_of_legs_first_player' => $request->get('count_of_legs_first_player'),
                    'average_first_player' => $request->get('average_first_player'),
                    'count_of_sets_second_player' => $request->get('count_of_sets_second_player'),
                    'count_of_legs_second_player' => $request->get('count_of_legs_second_player'),
                    'average_second_player' => $request->get('average_second_player'),
                    'darts_result_first_player' => $request->get('darts_result_first_player'),
                    'darts_result_second_player' => $request->get('darts_result_second_player')
                ];
                $season = Season::query()->find($game->season_id);

                $homePoints = MatchResults::from(intval($request->get('darts_result_first_player')));

                $prePoints =  $season->teams->where('id', '=', $game->home_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->home_team_id, ['points' => $prePoints + $homePoints->points()]);

                $awayPoints = MatchResults::from(intval($request->get('darts_result_second_player')));

                $prePoints =  $season->teams->where('id', '=', $game->away_team_id)->first()->pivot->score;

                $season->teams()->updateExistingPivot($game->away_team_id, ['points' => $prePoints + $awayPoints->points()]);


                $game->parameters = json_encode($params);
                break;
            }
            case 'Fotbal': {
                $params = [
                    'count_of_goals_home_team' => $request->get('count_of_goals_home_team'),
                    'holding_the_ball_home_team' => $request->get('holding_the_ball_home_team'),
                    'number_of_shots_on_goal_home_team' => $request->get('number_of_shots_on_goal_home_team'),
                    'number_of_shots_home_team' => $request->get('number_of_shots_home_team'),
                    'number_of_corner_home_team' => $request->get('number_of_corner_home_team'),
                    'number_of_offsides_home_team' => $request->get('number_of_offsides_home_team'),
                    'number_of_fouls_home_team' => $request->get('number_of_fouls_home_team'),
                    'number_of_red_cards_home_team' => $request->get('number_of_red_cards_home_team'),
                    'number_of_yellow_cards_home_team' => $request->get('number_of_yellow_cards_home_team'),
                    'count_of_goals_away_team' => $request->get('count_of_goals_away_team'),
                    'holding_the_ball_away_team' => $request->get('holding_the_ball_away_team'),
                    'number_of_shots_on_goal_away_team' => $request->get('number_of_shots_on_goal_away_team'),
                    'number_of_shots_away_team' => $request->get('number_of_shots_away_team'),
                    'number_of_corner_away_team' => $request->get('number_of_corner_away_team'),
                    'number_of_offsides_away_team' => $request->get('number_of_offsides_away_team'),
                    'number_of_fouls_away_team' => $request->get('number_of_fouls_away_team'),
                    'number_of_red_cards_away_team' => $request->get('number_of_red_cards_away_team'),
                    'number_of_yellow_cards_away_team' => $request->get('number_of_yellow_cards_away_team'),
                    'football_result_away_team' => $request->get('football_result_away_team'),
                    'football_result_home_team' => $request->get('football_result_home_team')
                ];

                $previousPointHome = MatchResults::from(intval($game->getMeta('football_result_home_team')))->points();

                $season = Season::query()->find($game->season_id);

                $homePointsNew = MatchResults::from(intval($request->get('football_result_home_team')));

                $prePoints =  $season->teams->where('id', '=', $game->home_team_id)->first()->pivot->points;

                $season->teams()->updateExistingPivot($game->home_team_id, ['points' => $prePoints - $previousPointHome + $homePointsNew->points()]);

                $previousPointAway = MatchResults::from(intval($game->getMeta('football_result_away_team')))->points();

                $awayPointsNew = MatchResults::from(intval($request->get('football_result_away_team')));

                $prePoints =  $season->teams->where('id', '=', $game->away_team_id)->first()->pivot->points;

                $season->teams()->updateExistingPivot($game->away_team_id, ['points' => $prePoints - $previousPointAway + $awayPointsNew->points()]);



                $homePlayersWithAction = $request->get('players_home');
                $homeMinutesActions = $request->get('minutes_home');
                $homeActions = $request->get('actions_home');

                $params['actions_home'] = [];

                foreach ($homePlayersWithAction as $index => $homePlayer) {
                    $params['actions_home'][$homeMinutesActions[$index]][] = [
                        'player' => $homePlayer,
                        'action' => FootballActions::from(intval($homeActions[$index]))->value,
                        'type' => 'home'
                    ];
                }

                $awayPlayersWithAction = $request->get('players_away');
                $awayMinutesActions = $request->get('minutes_away');
                $awayActions = $request->get('actions_away');

                ksort($params['actions_home']);

                $params['actions_away'] = [];

                foreach ($awayPlayersWithAction as $index => $awayPlayer) {
                    $params['actions_away'][$awayMinutesActions[$index]][] = [
                        'player' => $awayPlayer,
                        'action' => FootballActions::from(intval($awayActions[$index]))->value,
                        'type' => 'away'
                    ];
                }

                ksort($params['actions_away']);
                $params['actions'] = merge_arrays_preserve_keys($params['actions_home'], $params['actions_away']);


                ksort($params['actions']);

                $game->parameters = json_encode($params);
                break;
            }
            case 'Hokej': {
                $params = [
                    'hockey_count_of_goals_home_team' => $request->get('hockey_count_of_goals_home_team'),
                    'hockey_shooting_success_home_team' => $request->get('hockey_shooting_success_home_team'),
                    'hockey_number_of_shots_on_goal_home_team' => $request->get('hockey_number_of_shots_on_goal_home_team'),
                    'hockey_number_of_shots_home_team' => $request->get('hockey_number_of_shots_home_team'),
                    'hockey_number_of_exclusion_home_team' => $request->get('hockey_number_of_exclusion_home_team'),
                    'hockey_number_of_goalkeeper_interventions_home_team' => $request->get('hockey_number_of_goalkeeper_interventions_home_team'),
                    'hockey_number_of_blocked_shots_home_team' => $request->get('hockey_number_of_blocked_shots_home_team'),
                    'hockey_number_of_power_play_goals_home_team' => $request->get('hockey_number_of_power_play_goals_home_team'),
                    'hockey_number_of_buly_won_home_team' => $request->get('hockey_number_of_buly_won_home_team'),
                    'hockey_count_of_goals_away_team' => $request->get('hockey_count_of_goals_away_team'),
                    'hockey_shooting_success_away_team' => $request->get('hockey_shooting_success_away_team'),
                    'hockey_number_of_shots_on_goal_away_team' => $request->get('hockey_number_of_shots_on_goal_away_team'),
                    'hockey_number_of_shots_away_team' => $request->get('hockey_number_of_shots_away_team'),
                    'hockey_number_of_exclusion_away_team' => $request->get('hockey_number_of_exclusion_away_team'),
                    'hockey_number_of_goalkeeper_interventions_away_team' => $request->get('hockey_number_of_goalkeeper_interventions_away_team'),
                    'hockey_number_of_blocked_shots_away_team' => $request->get('hockey_number_of_blocked_shots_away_team'),
                    'hockey_number_of_power_play_goals_away_team' => $request->get('hockey_number_of_power_play_goals_away_team'),
                    'hockey_number_of_buly_won_away_team' => $request->get('hockey_number_of_buly_won_away_team'),
                    'hockey_result_away_team' => $request->get('hockey_result_away_team'),
                    'hockey_result_home_team' => $request->get('hockey_result_home_team')
                ];

                $previousPointHome = MatchResults::from(intval($game->getMeta('hockey_result_home_team')))->points();

                $season = Season::query()->find($game->season_id);

                $homePointsNew = MatchResults::from(intval($request->get('hockey_result_home_team')));

                $prePoints =  $season->teams->where('id', '=', $game->home_team_id)->first()->pivot->points;

                $season->teams()->updateExistingPivot($game->home_team_id, ['points' => $prePoints - $previousPointHome + $homePointsNew->points()]);

                $previousPointAway = MatchResults::from(intval($game->getMeta('hockey_result_away_team')))->points();

                $awayPointsNew = MatchResults::from(intval($request->get('hockey_result_away_team')));

                $prePoints =  $season->teams->where('id', '=', $game->away_team_id)->first()->pivot->points;

                $season->teams()->updateExistingPivot($game->away_team_id, ['points' => $prePoints - $previousPointAway + $awayPointsNew->points()]);


                $homePlayersWithAction = $request->get('hockey_players_home');
                $homeMinutesActions = $request->get('hockey_minutes_home');
                $homeActions = $request->get('hockey_actions_home');

                $params['hockey_actions_home'] = [];

                foreach ($homePlayersWithAction as $index => $homePlayer) {
                    $params['hockey_actions_home'][$homeMinutesActions[$index]][] = [
                        'player' => $homePlayer,
                        'action' => HockeyActions::from(intval($homeActions[$index]))->value,
                        'type' => 'home'
                    ];
                }

                ksort($params['hockey_actions_home']);

                $awayPlayersWithAction = $request->get('hockey_players_away');
                $awayMinutesActions = $request->get('hockey_minutes_away');
                $awayActions = $request->get('hockey_actions_away');

                $params['hockey_actions_away'] = [];

                foreach ($awayPlayersWithAction as $index => $awayPlayer) {
                    $params['hockey_actions_away'][$awayMinutesActions[$index]][] = [
                        'player' => $awayPlayer,
                        'action' => HockeyActions::from(intval($awayActions[$index]))->value,
                        'type' => 'away'
                    ];
                }

                ksort($params['hockey_actions_away']);

                $params['actions'] = array_replace($params['hockey_actions_home'], $params['hockey_actions_away']);

                ksort($params['actions']);

                $game->parameters = json_encode($params);
            }
        }



        $game->save();
        $game->referees()->detach();


        foreach ($request->get('referees') as $referee) {
            $game->referees()->attach($referee);

        }

        return redirect()->route('admin.games.show-update', $game->id);
    }
}
