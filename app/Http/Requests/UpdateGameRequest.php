<?php

namespace App\Http\Requests;

use App\Modules\Leagues\Models\League;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    public function rules(): array
    {
        $sportName = League::query()->where('id', '=', $this->get('league'))->first()->sport->name;

        $rules = [
            'date_of_match' => ['required', 'date'],
            'lap' => ['required', 'integer'],
            'supervisor' => ['required', 'integer'],
            'away_team' => ['required', 'integer'],
            'home_team' => ['required', 'integer'],
            'league' => ['required', 'integer'],
            'season' => ['required', 'integer']
        ];

        switch ($sportName) {
            case "Fotbal":
                $rules['count_of_goals_home_team'] = ['required', 'integer'];
                $rules['holding_the_ball_home_team'] = ['required', 'integer'];
                $rules['number_of_shots_on_goal_home_team'] = ['required', 'integer'];
                $rules['number_of_shots_home_team'] = ['required', 'integer'];
                $rules['number_of_corner_home_team'] = ['required', 'integer'];
                $rules['number_of_offsides_home_team'] = ['required', 'integer'];
                $rules['number_of_fouls_home_team'] = ['required', 'integer'];
                $rules['number_of_red_cards_home_team'] = ['required', 'integer'];
                $rules['number_of_yellow_cards_home_team'] = ['required', 'integer'];
                $rules['count_of_goals_away_team'] = ['required', 'integer'];
                $rules['holding_the_ball_away_team'] = ['required', 'integer'];
                $rules['number_of_shots_on_goal_away_team'] = ['required', 'integer'];
                $rules['number_of_shots_away_team'] = ['required', 'integer'];
                $rules['number_of_corner_away_team'] = ['required', 'integer'];
                $rules['number_of_offsides_away_team'] = ['required', 'integer'];
                $rules['number_of_fouls_away_team'] = ['required', 'integer'];
                $rules['number_of_red_cards_away_team'] = ['required', 'integer'];
                $rules['number_of_yellow_cards_away_team'] = ['required', 'integer'];
                $rules['players_home'] = ['array', 'nullable'];
                $rules['minutes_home'] = ['array', 'nullable'];
                $rules['actions_home'] = ['array', 'nullable'];
                $rules['players_away'] = ['array', 'nullable'];
                $rules['minutes_away'] = ['array', 'nullable'];
                $rules['actions_away'] = ['array', 'nullable'];
                break;
            case "Hokej":
                $rules['hockey_count_of_goals_home_team'] = ['required', 'integer'];
                $rules['hockey_shooting_success_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_shots_on_goal_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_shots_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_exclusion_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_goalkeeper_interventions_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_blocked_shots_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_power_play_goals_home_team'] = ['required', 'integer'];
                $rules['hockey_number_of_buly_won_home_team'] = ['required', 'integer'];
                $rules['hockey_count_of_goals_away_team'] = ['required', 'integer'];
                $rules['holding_the_ball_away_team'] = ['required', 'integer'];
                $rules['hockey_shooting_success_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_shots_on_goal_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_shots_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_exclusion_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_goalkeeper_interventions_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_blocked_shots_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_buly_won_away_team'] = ['required', 'integer'];
                $rules['hockey_number_of_power_play_goals_away_team'] = ['required', 'integer'];
                $rules['hockey_players_home'] = ['array', 'nullable'];
                $rules['hockey_minutes_home'] = ['array', 'nullable'];
                $rules['hockey_actions_home'] = ['array', 'nullable'];
                $rules['hockey_players_away'] = ['array', 'nullable'];
                $rules['hockey_minutes_away'] = ['array', 'nullable'];
                $rules['hockey_actions_away'] = ['array', 'nullable'];

                break;
            case "Šipky":
                $rules['count_of_sets_first_player'] = ['required', 'integer'];
                $rules['count_of_legs_first_player'] = ['required', 'integer'];
                $rules['average_first_player'] = ['required'];
                $rules['count_of_sets_second_player'] = ['required', 'integer'];
                $rules['count_of_legs_second_player'] = ['required', 'integer'];
                $rules['average_player_two'] = ['required'];
                $rules['best_of'] = ['required'];
                break;
            default:
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'season.required' => 'Sezóna musí být vybraná',
            'home_team.required' => 'Domácí tým musí být vybrán',
            'away_team.required' => 'Hostující tým musí být vybrán',
            'best_of.required' => 'Nejlepší z musí být vyplněno',
            'count_of_sets_first_player.required' => 'Počet setů prvního hráče musí být vyplněno',
            'count_of_sets_first_player.integer' => 'Počet setů prvního hráče musí být číslo',
            'count_of_legs_first_player.required' => 'Počet legů prvního hráče musí být vyplněno',
            'count_of_legs_first_player.integer' => 'Počet legů prvního hráče musí být číslo',
            'average_first_player.required' => 'Průměr 3 šipek prvního hráče musí být vyplněno',
            'count_of_sets_second_player.required' => 'Počet setů druhého hráče musí být vyplněno',
            'count_of_sets_second_player.integer' => 'Počet setů druhého hráče musí být číslo',
            'count_of_legs_second_player.required' => 'Počet legů druhého hráče musí být vyplněno',
            'count_of_legs_second_player.integer' => 'Počet legů druhého hráče musí být číslo',
            'average_second_player.required' => 'Průměr 3 šipek druhého hráče musí být vyplněno',
            'date_of_match.required' => 'Datum konání musí být vyplněno',
            'date_of_match.date' => 'Datum je v neodpovídajícím formátu',
            'lap.required' => 'Kolo musí být vyplněno',
            'lap.integer' => 'Kolo musí být číslo',
            'number_of_shots_on_goal_home_team.required' => 'Počet střel na gól domácího týmu musí být vyplněno',
            'number_of_shots_on_goal_home_team.integer' => 'Počet střel na gól domácího týmu musí být číslo',
            'number_of_shots_home_team.required' => 'Počet střel domácího týmu musí být vyplněno',
            'number_of_shots_home_team.integer' => 'Počet střel domácího týmu musí být číslo',
            'number_of_corner_home_team.required' => 'Počet rohů domácího týmu musí být vyplněno',
            'number_of_corner_home_team.integer' => 'Počet rohů domácího týmu musí být číslo',
            'number_of_offsides_home_team.required' => 'Počet ofsajdů domácího týmu musí být vyplněno',
            'number_of_offsides_home_team.integer' => 'Počet ofsajdů domácího týmu musí být číslo',
            'number_of_fouls_home_team.required' => 'Počet faulů domácího týmu musí být vyplněno',
            'number_of_fouls_home_team.integer' => 'Počet faulů domácího týmu musí být číslo',
            'number_of_red_cards_home_team.required' => 'Počet červených karet domácího týmu musí být vyplněno',
            'number_of_red_cards_home_team.integer' => 'Počet červených domácího týmu musí být číslo',
            'number_of_yellow_cards_home_team.required' => 'Počet žlutých karet domácího týmu musí být vyplněno',
            'number_of_yellow_cards_home_team.integer' => 'Počet žlutých domácího týmu musí být číslo',
            'holding_the_ball_home_team.required' => 'Držení míče domácího týmu je povinné',
            'holding_the_ball_home_team.integer' => 'Držení míče domácího týmu musí být číslo',
            'count_of_goals_home_team.required' => 'Počet gólů domácího týmu je povinný údaj',
            'players_home.array' => 'Seznám hráčů musí být pole',
            'minutes_home.array' => 'Seznám minut musí být pole',
            'actions_home.array' => 'Seznám akcí musí být pole',

            'number_of_shots_on_goal_away_team.required' => 'Počet střel na gól hostujícího týmu musí být vyplněno',
            'number_of_shots_on_goal_away_team.integer' => 'Počet střel na gól hostujícího týmu musí být číslo',
            'number_of_shots_away_team.required' => 'Počet střel hostujícího týmu musí být vyplněno',
            'number_of_shots_away_team.integer' => 'Počet střel hostujícího týmu musí být číslo',
            'number_of_corner_away_team.required' => 'Počet rohů hostujícího týmu musí být vyplněno',
            'number_of_corner_away_team.integer' => 'Počet rohů hostujícího týmu musí být číslo',
            'number_of_offsides_away_team.required' => 'Počet ofsajdů hostujícího týmu musí být vyplněno',
            'number_of_offsides_away_team.integer' => 'Počet ofsajdů hostujícího týmu musí být číslo',
            'number_of_fouls_away_team.required' => 'Počet faulů hostujícího týmu musí být vyplněno',
            'number_of_fouls_away_team.integer' => 'Počet faulů hostujícího týmu musí být číslo',
            'number_of_red_cards_away_team.required' => 'Počet červených karet hostujícího týmu musí být vyplněno',
            'number_of_red_cards_away_team.integer' => 'Počet červených hostujícího týmu musí být číslo',
            'number_of_yellow_cards_away_team.required' => 'Počet žlutých karet hostujícího týmu musí být vyplněno',
            'number_of_yellow_cards_away_team.integer' => 'Počet žlutých hostujícího týmu musí být číslo',
            'holding_the_ball_away_team.required' => 'Držení míče hostujícího týmu je povinné',
            'holding_the_ball_away_team.integer' => 'Držení míče hostujícího týmu musí být číslo',
            'count_of_goals_away_team.required' => 'Počet gólů hostujícího týmu je povinný údaj',

            'players_away.array' => 'Seznám hráčů musí být pole',
            'minutes_away.array' => 'Seznám minut musí být pole',
            'actions_away.array' => 'Seznám akcí musí být pole',


            'hockey_count_of_goals_home_team.required' => 'Počet gólů domácího týmu musí být vyplněno',
            'hockey_count_of_goals_home_team.integer' => 'Počet gólů domácího týmu musí být číslo',
            'hockey_number_of_shots_on_goal_home_team.required' => 'Počet střel na gól domácího týmu musí být vyplněno',
            'hockey_number_of_shots_on_goal_home_team.integer' => 'Počet střel na gól domácího týmu musí být číslo',
            'hockey_shooting_success_home_team.required' => 'Úspěšnost střel domácího týmu musí být vyplněno',
            'hockey_shooting_success_home_team.integer' => 'Úspěšnost střel domácího týmu musí být číslo',
            'hockey_number_of_shots_home_team.required' => 'Počet střel domácího týmu musí být vyplněno',
            'hockey_number_of_shots_home_team.integer' => 'Počet střel domácího týmu musí být číslo',
            'hockey_number_of_exclusion_home_team.required' => 'Počet faulů domácího týmu musí být vyplněno',
            'hockey_number_of_exclusion_home_team.integer' => 'Počet faulů domácího týmu musí být číslo',
            'hockey_number_of_goalkeeper_interventions_home_team.required' => 'Počet zákroků brankaře domácího týmu musí být vyplněno',
            'hockey_number_of_goalkeeper_interventions_home_team.integer' => 'Počet zákroků brankaře domácího týmu musí být číslo',
            'hockey_number_of_blocked_shots_home_team.required' => 'Počet zablokovaných střel domácího týmu musí být vyplněno',
            'hockey_number_of_blocked_shots_home_team.integer' => 'Počet zablokovaných střel domácího týmu musí být číslo',
            'hockey_number_of_power_play_goals_home_team.required' => 'Počet gólů v přesilové hře domácího týmu je povinné',
            'hockey_number_of_power_play_goals_home_team.integer' => 'Počet gólů v přesilové hře domácího týmu musí být číslo',
            'hockey_number_of_buly_won_home_team.required' => 'Počet vyhraných buly domácího týmu je povinné',
            'hockey_number_of_buly_won_home_team.integer' => 'Počet vyhraných buly domácího týmu musí být číslo',

            'hockey_players_home.array' => 'Seznám hráčů musí být pole',
            'hockey_minutes_home.array' => 'Seznám minut musí být pole',
            'hockey_actions_home.array' => 'Seznám akcí musí být pole',

            'hockey_count_of_goals_away_team.required' => 'Počet gólů hostujícího týmu musí být vyplněno',
            'hockey_count_of_goals_away_team.integer' => 'Počet gólů hostujícího týmu musí být číslo',
            'hockey_number_of_shots_on_goal_away_team.required' => 'Počet střel na gól hostujícího týmu musí být vyplněno',
            'hockey_number_of_shots_on_goal_away_team.integer' => 'Počet střel na gól hostujícího týmu musí být číslo',
            'hockey_shooting_success_away_team.required' => 'Úspěšnost střel hostujícího týmu musí být vyplněno',
            'hockey_shooting_success_away_team.integer' => 'Úspěšnost střel hostujícího týmu musí být číslo',
            'hockey_number_of_shots_away_team.required' => 'Počet střel hostujícího týmu musí být vyplněno',
            'hockey_number_of_shots_away_team.integer' => 'Počet střel hostujícího týmu musí být číslo',
            'hockey_number_of_exclusion_away_team.required' => 'Počet faulů hostujícího týmu musí být vyplněno',
            'hockey_number_of_exclusion_away_team.integer' => 'Počet faulů hostujícího týmu musí být číslo',
            'hockey_number_of_goalkeeper_interventions_away_team.required' => 'Počet zákroků brankaře hostujícího týmu musí být vyplněno',
            'hockey_number_of_goalkeeper_interventions_away_team.integer' => 'Počet zákroků brankaře hostujícího týmu musí být číslo',
            'hockey_number_of_blocked_shots_away_team.required' => 'Počet zablokovaných střel hostujícího týmu musí být vyplněno',
            'hockey_number_of_blocked_shots_away_team.integer' => 'Počet zablokovaných střel hostujícího týmu musí být číslo',
            'hockey_number_of_power_play_goals_away_team.required' => 'Počet gólů v přesilové hře hostujícího týmu je povinné',
            'hockey_number_of_power_play_goals_away_team.integer' => 'Počet gólů v přesilové hře hostujícího týmu musí být číslo',
            'hockey_number_of_buly_won_away_team.required' => 'Počet vyhraných buly hostujícího týmu je povinné',
            'hockey_number_of_buly_won_away_team.integer' => 'Počet vyhraných buly hostujícího týmu musí být číslo',


            'hockey_players_away.array' => 'Seznám hráčů musí být pole',
            'hockey_minutes_away.array' => 'Seznám minut musí být pole',
            'hockey_actions_away.array' => 'Seznám akcí musí být pole',
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
