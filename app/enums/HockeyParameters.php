<?php

namespace App\enums;

enum HockeyParameters: string
{
    case HOCKEY_COUNT_OF_GOALS_HOME_TEAM = 'hockey_count_of_goals_home_team';

    case HOCKEY_SHOOTING_SUCCESS_HOME_TEAM = 'hockey_shooting_success_home_team';

    case HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM = 'hockey_number_of_shots_on_goal_home_team';

    case HOCKEY_NUMBER_OF_SHOTS_HOME_TEAM = 'hockey_number_of_shots_home_team';

    case HOCKEY_NUMBER_OF_EXCLUSION_HOME_TEAM = 'hockey_number_of_exclusion_home_team';

    case HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_HOME_TEAM = 'hockey_number_of_goalkeeper_interventions_home_team';

    case HOCKEY_NUMBER_OF_BLOCKED_SHOTS_HOME_TEAM = 'hockey_number_of_blocked_shots_home_team';

    case HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_HOME_TEAM = 'hockey_number_of_power_play_goals_home_team';

    case HOCKEY_NUMBER_OF_BULY_WON_HOME_TEAM = 'hockey_number_of_buly_won_home_team';

    case HOCKEY_COUNT_OF_GOALS_AWAY_TEAM = 'hockey_count_of_goals_away_team';

    case HOCKEY_SHOOTING_SUCCESS_AWAY_TEAM = 'hockey_shooting_success_away_team';

    case HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM = 'hockey_number_of_shots_on_goal_away_team';

    case HOCKEY_NUMBER_OF_SHOTS_AWAY_TEAM = 'hockey_number_of_shots_away_team';

    case HOCKEY_NUMBER_OF_EXCLUSION_AWAY_TEAM = 'hockey_number_of_exclusion_away_team';

    case HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_AWAY_TEAM = 'hockey_number_of_goalkeeper_interventions_away_team';

    case HOCKEY_NUMBER_OF_BLOCKED_SHOTS_AWAY_TEAM = 'hockey_number_of_blocked_shots_away_team';

    case HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_AWAY_TEAM = 'hockey_number_of_power_play_goals_away_team';

    case HOCKEY_NUMBER_OF_BULY_WON_AWAY_TEAM = 'hockey_number_of_buly_won_away_team';


    case HOCKEY_ACTIONS_HOME = 'hockey_actions_home';

    case HOCKEY_ACTIONS_AWAY = 'hockey_actions_away';

}
