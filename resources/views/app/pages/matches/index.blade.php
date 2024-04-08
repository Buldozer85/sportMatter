<x-app.app title="Zápas">
    <div class="text-white flex justify-center">
        <x-app.matches.matchesContainer class="mt-20 matchContainerDetail text-center" date="{{ $match->date_of_match->format('d.n.Y') }}" day_name="{{ $match->day }}" name_of_league="{{ $match->season_league_label }}" img_src="img/football-ball-soccer-svgrepo-com.png">
            <x-app.matches.matchDetail
                time="{{ $match->date_of_match->format('H:i') }}"
                home_team_name="{{ $match->homeTeam->name }}"
                away_team_name="{{ $match->awayTeam->name }}"
                home_team_score="{{ $match->home_score }}"
                away_team_score="{{ $match->away_score }}"
                :referees="$match->referees"
                stadium="{{ $match->homeTeam->stadium->name }}">
                @if($match->league->sport->name === 'Fotbal')
                <x-slot name="overview">
                    @foreach($match->getMeta('actions') as $key => $minuteActions)
                            @foreach($minuteActions as $actionsArray)
                                @foreach($actionsArray as $action)
                                    @if($action['type'] == 'home')
                                        <x-app.matches.homeParticipant minute="{{ $key }}" action_image="img/football-ball-soccer-svgrepo-com.png" player_name="{{ $action['player'] }}"/>
                                @else
                                    <x-app.matches.awayParticipant minute="{{ $key }}" action_image="img/football-ball-soccer-svgrepo-com.png" player_name="{{ $action['player'] }}"/>
                                @endif
                                @endforeach

                            @endforeach
                    @endforeach

                </x-slot>

                <x-slot name="statistics">
                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::HOLDING_THE_BALL_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::HOLDING_THE_BALL_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::HOLDING_THE_BALL_AWAY_TEAM->value) }}"/>

                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM->value) }}"/>

                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_SHOTS_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_AWAY_TEAM->value) }}"/>

                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_CORNER_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_CORNER_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_CORNER_AWAY_TEAM->value) }}"/>

                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_OFFSIDES_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_OFFSIDES_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_OFFSIDES_AWAY_TEAM->value) }}"/>

                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_FOULS_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_FOULS_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_FOULS_AWAY_TEAM->value) }}"/>

                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_AWAY_TEAM->value) }}"/>


                    <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_RED_CARDS_HOME_TEAM->label() }}"
                                        home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_RED_CARDS_HOME_TEAM->value) }}"
                                        away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_RED_CARDS_AWAY_TEAM->value) }}"/>

                </x-slot>
                @endif

                @if($match->league->sport->name === 'Hokej')
                        <x-slot name="overview">


                        </x-slot>

                        <x-slot name="statistics">
                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_SHOOTING_SUCCESS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_SHOOTING_SUCCESS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_SHOOTING_SUCCESS_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_NUMBER_OF_EXCLUSION_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_EXCLUSION_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_EXCLUSION_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BLOCKED_SHOTS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BLOCKED_SHOTS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BLOCKED_SHOTS_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\HockeyParameters::HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_AWAY_TEAM->value) }}"/>
                        </x-slot>
                @endif

                    @if($match->league->sport->name === 'Šipky')
                        <x-slot name="overview">

                        </x-slot>

                        <x-slot name="statistics">
                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::HOLDING_THE_BALL_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::HOLDING_THE_BALL_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::HOLDING_THE_BALL_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_SHOTS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_CORNER_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_CORNER_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_CORNER_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_OFFSIDES_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_OFFSIDES_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_OFFSIDES_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_FOULS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_FOULS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_FOULS_AWAY_TEAM->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_AWAY_TEAM->value) }}"/>


                            <x-app.matches.stat name="{{ \App\enums\FootballParameters::NUMBER_OF_RED_CARDS_HOME_TEAM->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_RED_CARDS_HOME_TEAM->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\FootballParameters::NUMBER_OF_RED_CARDS_AWAY_TEAM->value) }}"/>

                        </x-slot>

                        <x-slot name="statistics">
                            <x-app.matches.stat name="{{ \App\enums\DartsParameters::COUNT_OF_SETS_FIRST_PLAYER->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\DartsParameters::COUNT_OF_SETS_FIRST_PLAYER->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\DartsParameters::COUNT_OF_SETS_SECOND_PLAYER->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\DartsParameters::COUNT_OF_LEGS_FIRST_PLAYER->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\DartsParameters::COUNT_OF_LEGS_FIRST_PLAYER->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\DartsParameters::COUNT_OF_LEGS_SECOND_PLAYER->value) }}"/>

                            <x-app.matches.stat name="{{ \App\enums\DartsParameters::AVERAGE_FIRST_PLAYER->label() }}"
                                                home_team="{{ $match->getMeta(\App\enums\DartsParameters::AVERAGE_FIRST_PLAYER->value) }}"
                                                away_team="{{ $match->getMeta(\App\enums\DartsParameters::AVERAGE_SECOND_PLAYER->value) }}"/>
                        </x-slot>
                    @endif
            </x-app.matches.matchDetail>
        </x-app.matches.matchesContainer>
    </div>
</x-app.app>
