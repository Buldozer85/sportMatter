<?php

namespace App\enums;

enum FootballParameters: string
{
    case COUNT_OF_GOALS_HOME_TEAM = 'count_of_goals_home_team';

    case HOLDING_THE_BALL_HOME_TEAM = 'holding_the_ball_home_team';

    case NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM = 'number_of_shots_on_goal_home_team';

    case NUMBER_OF_SHOTS_HOME_TEAM = 'number_of_shots_home_team';

    case NUMBER_OF_CORNER_HOME_TEAM = 'number_of_corner_home_team';

    case NUMBER_OF_OFFSIDES_HOME_TEAM = 'number_of_offsides_home_team';

    case NUMBER_OF_FOULS_HOME_TEAM = 'number_of_fouls_home_team';

    case NUMBER_OF_RED_CARDS_HOME_TEAM = 'number_of_red_cards_home_team';

    case NUMBER_OF_YELLOW_CARDS_HOME_TEAM = 'number_of_yellow_cards_home_team';

    case COUNT_OF_GOALS_AWAY_TEAM = 'count_of_goals_away_team';

    case HOLDING_THE_BALL_AWAY_TEAM = 'holding_the_ball_away_team';

    case NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM = 'number_of_shots_on_goal_away_team';

    case NUMBER_OF_SHOTS_AWAY_TEAM = 'number_of_shots_away_team';

    case NUMBER_OF_CORNER_AWAY_TEAM = 'number_of_corner_away_team';

    case NUMBER_OF_OFFSIDES_AWAY_TEAM = 'number_of_offsides_away_team';

    case NUMBER_OF_FOULS_AWAY_TEAM = 'number_of_fouls_away_team';

    case NUMBER_OF_RED_CARDS_AWAY_TEAM = 'number_of_red_cards_away_team';

    case NUMBER_OF_YELLOW_CARDS_AWAY_TEAM = 'number_of_yellow_cards_away_team';

    case ACTIONS_HOME = 'actions_home';

    case ACTIONS_AWAY = 'actions_away';

    public function label(): string
    {
        return match($this) {
            self::COUNT_OF_GOALS_AWAY_TEAM, self::COUNT_OF_GOALS_HOME_TEAM => 'Počet gólů',
            self::HOLDING_THE_BALL_AWAY_TEAM, self::HOLDING_THE_BALL_HOME_TEAM => 'Držení míče',
            self::NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM, self::NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM => 'Počet střel na bránu',
            self::NUMBER_OF_SHOTS_AWAY_TEAM, self::NUMBER_OF_SHOTS_HOME_TEAM => 'Počet střel',
            self::NUMBER_OF_CORNER_HOME_TEAM, self::NUMBER_OF_CORNER_AWAY_TEAM => 'Počet rohů',
            self::NUMBER_OF_OFFSIDES_HOME_TEAM, self::NUMBER_OF_OFFSIDES_AWAY_TEAM => 'Počet ofsajdů',
            self::NUMBER_OF_FOULS_HOME_TEAM, self::NUMBER_OF_FOULS_AWAY_TEAM => 'Počet faulů',
            self::NUMBER_OF_YELLOW_CARDS_HOME_TEAM, self::NUMBER_OF_YELLOW_CARDS_AWAY_TEAM => 'Počet žlutých karet',
            self::NUMBER_OF_RED_CARDS_AWAY_TEAM, self::NUMBER_OF_RED_CARDS_HOME_TEAM => 'Počet červených karet',
            self::ACTIONS_HOME => 'Akce domácí',
            self::ACTIONS_AWAY => 'Akce hostující',
        };

    }

}
