<div x-data="{
    selectedSport: '{{ $sportName }}'
}">

    <div>
        <div class="flex flex-row gap-5">
            <div class="w-6/12">
                <x-admin.forms.select
                    wire:model.live="selectedLeague"
                    label="Liga"
                    id="league"
                    name="league"
                    :options="$leaguesOptions"
                    selected="{{$game->league_id ?? old('league')}}"

                />
            </div>

            <div class="w-6/12">
                <x-admin.forms.select
                    label="Sezóna"
                    id="season"
                    name="season"
                    :options="$seasonsOptions"
                    :selected="$game->season_id ?? old('season')"
                />
            </div>
        </div>


        <div class="flex flex-row gap-5">
            <div class="w-6/12">
                <x-admin.forms.select
                    wire:model.live="selectedHome"
                    label="Domácí tým/hráč"
                    {{--         TODO: měnit podle selected sportu, výsledky zapisovat v params           --}}
                    id="home_team"
                    name="home_team"
                    :options="$homeTeamOptions"
                    :selected="$game->home_team_id ?? old('home_team')"
                />
            </div>
            <div class="w-6/12">
                <x-admin.forms.select
                    wire:model.live="selectedAway"
                    label="Venkovní tým/hráč"
                    id="away_team"
                    name="away_team"
                    :options="$awayTeamOptions"
                    :selected="$game->away_team_id ?? old('away_team')"
                />
            </div>
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="w-6/12">
            <x-admin.forms.input type="datetime-local" name="date_of_match" id="date_of_match" label="Datum zápasu" value="{{ $game->date_of_match?->format('Y-m-d H:i') ?? old('date_of_match') }}"/>
        </div>
        <div class="w-6/12">
            <x-admin.forms.input type="text" name="lap" id="lap" label="Kolo" value="{{ $game->lap ?? old('lap') }}"/>
        </div>
    </div>
    <div class="flex flex-row gap-5">
        <div class="w-6/12">
            <x-admin.forms.select
                label="Adminstrátor zápasu"
                id="supervisor"
                name="supervisor"
                :options="$supervisorOptions"
                :selected="$game->supervisor_id ?? ''"
            />
        </div>
    </div>
    <div x-data="{refereeCount: {{ $game->referees->count() }} }">
        <div class="flex flex-row gap-5">
            <div class="w-full" x-ref="teamContainer">
                <x-admin.forms.select
                    label="Rozhodčí"
                    id=""
                    name="referees[]"
                    :options="$refereesOptions"
                />
            </div>
        </div>
        <div class="mt-3">
            <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="refereeCount++; $refs.teamContainer.appendChild($refs.teamContainer.children[0].cloneNode(true))"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
            <button x-show="refereeCount >= 2" type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="$refs.teamContainer.removeChild($refs.teamContainer.lastElementChild); refereeCount--" x-ref="removeBtn" style="display: none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                </svg>
            </button>

        </div>
        <h2 class="mt-2 font-bold">Parametry</h2>
        <div>
            <div x-show="$wire.sportName === 'Šipky'">
                <x-admin.forms.input name="best_of" id="best_of" label="Nejlepší z x"/> {{--         Myšlwno jako text input, bude se tam zadávat např. z 5 legů nebo 3 setů
                            --}}
                <h3 class="mt-4 font-bold">1. hráč</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_sets_first_player"
                                             name="count_of_sets_first_player"
                                             type="number"
                                             label="Počet vyhraných setů"
                                             value="{{ $game->getMeta(\App\enums\DartsParameters::COUNT_OF_SETS_FIRST_PLAYER->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_legs_first_player"
                                             name="count_of_legs_first_player"
                                             type="number"
                                             label="Počet vyhraných legů"
                                             value="{{ $game->getMeta(\App\enums\DartsParameters::COUNT_OF_LEGS_FIRST_PLAYER->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="average_first_player"
                                             name="average_first_player"
                                             label="Průměr na 3 šipky 1.hráče"
                                             value="{{ $game->getMeta(\App\enums\DartsParameters::AVERAGE_FIRST_PLAYER->value) }}"
                        />
                    </div>
                </div>

                <h3 class="mt-4 font-bold">2. hráč</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_sets_second_player"
                                             name="count_of_sets_second_player"
                                             type="number"
                                             label="Počet vyhraných setů"
                                             value="{{ $game->getMeta(\App\enums\DartsParameters::COUNT_OF_SETS_SECOND_PLAYER->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_legs_second_player"
                                             name="count_of_legs_second_player"
                                             type="number"
                                             label="Počet vyhraných legů"
                                             value="{{ $game->getMeta(\App\enums\DartsParameters::COUNT_OF_LEGS_SECOND_PLAYER->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="average_player_two"
                                             name="average_player_two"
                                             label="Průměr na 3 šipky"
                                             value="{{ $game->getMeta(\App\enums\DartsParameters::AVERAGE_SECOND_PLAYER->value) }}"
                        />
                    </div>
                </div>
            </div>

            <div x-show="$wire.sportName === 'Fotbal'">
                <h3 class="mt-4 font-bold">Domácí tým</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input type="number" name="count_of_goals_home_team"
                                             id="count_of_goals_home_team"
                                             label="Počet gólů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::COUNT_OF_GOALS_HOME_TEAM->value) }}"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input type="number" name="holding_the_ball_home_team"
                                             id="holding_the_ball_home_team"
                                             label="% držení míče" value="{{ $game->getMeta(\App\enums\FootballParameters::HOLDING_THE_BALL_HOME_TEAM->value) }}"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_on_goal_home_team"
                                             id="number_of_shots_on_goal_home_team"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->value) }}"
                                             label="Počet střel na bránu"/>
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_home_team"
                                             id="number_of_shots_home_team"
                                             type="number"
                                             label="Počet střel"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_HOME_TEAM->value) }}"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_corner_home_team"
                                             id="number_of_corner_home_team"
                                             type="number"
                                             label="Počet rohových kopů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_CORNER_HOME_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_offsides_home_team"
                                             id="number_of_offsides_home_team"
                                             type="number"
                                             label="Počet ofsajdů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_OFFSIDES_HOME_TEAM->value) }}"
                        />
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_fouls_home_team"
                                             id="number_of_fouls_home_team"
                                             type="number"
                                             label="Počet faulů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_FOULS_HOME_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_red_cards_home_team"
                                             id="number_of_red_cards_home_team"
                                             label="Počet červených karet"
                                             type="number"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_RED_CARDS_HOME_TEAM->value) }}"

                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_yellow_cards_home_team"
                                             id="number_of_yellow_cards_home_team"
                                             type="number"
                                             label="Počet žlutých karet"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_HOME_TEAM->value) }}"
                        />
                    </div>


                </div>
                <div class="w-6/12">
                    <x-admin.forms.select name="football_result_home_team"
                                          id="football_result_away_team"
                                          label="Výsledek hostující tým"
                                          :options="\App\enums\MatchResults::FootballOptions()"
                                          selected="{{ $game->getMeta('football_result_home_team')}}"
                    />
                </div>

                <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
                <div x-data="{ playerCount: {{ $game->home_actions_count }} }">
                    @if(is_null($game->id))
                        <div  x-ref="footBallHomePlayerContainer">
                            <div class="flex flex-row gap-5">
                            <div class="w-6/12">
                                <x-admin.forms.input
                                    label="Jméno hráče"
                                    :id="''"
                                    :name="'players_home[]'"
                                />
                            </div>
                            <div class="w-6/12">
                                <x-admin.forms.input
                                    label="Minuta"
                                    :id="''"
                                    :name="'minutes_home[]'"
                                />
                            </div>
                            <div class="w-6/12">
                                <x-admin.forms.select
                                    label="Akce"
                                    :id="''"
                                    :name="'actions_home[]'"
                                    :options="\App\enums\FootballActions::options()"
                                />
                            </div>
                        </div>
                            </div>
                    @else
                        @if($sportName === 'Fotbal' && !is_null($game->getMeta(\App\enums\FootballParameters::ACTIONS_HOME->value)))
                            <div id="ref" x-ref="footBallHomePlayerContainer">
                            @foreach($game->getMeta(\App\enums\FootballParameters::ACTIONS_HOME->value) as $key => $action)

                                @foreach($action as $minuteAction)
                                        <div class="flex flex-row gap-5">
                                            <div class="w-6/12">
                                                <x-admin.forms.input
                                                    label="Jméno hráče"
                                                    :id="''"
                                                    :name="'players_home[]'"
                                                    value="{{ $minuteAction['player'] }}"
                                                />
                                            </div>
                                            <div class="w-6/12">
                                                <x-admin.forms.input
                                                    label="Minuta"
                                                    :id="''"
                                                    :name="'minutes_home[]'"
                                                    value="{{ $key }}"
                                                />
                                            </div>
                                            <div class="w-6/12">
                                                <x-admin.forms.select
                                                    label="Akce"
                                                    :id="''"
                                                    :name="'actions_home[]'"
                                                    :options="\App\enums\FootballActions::options()"
                                                    selected="{{ $minuteAction['action'] }}"
                                                />
                                            </div>
                                        </div>

                                @endforeach
                            @endforeach
                            </div>
                        @else
                            <div  x-ref="footBallHomePlayerContainer">
                                <div class="flex flex-row gap-5">
                                    <div class="w-6/12">
                                        <x-admin.forms.input
                                            label="Jméno hráče"
                                            :id="''"
                                            :name="'players_home[]'"
                                        />
                                    </div>
                                    <div class="w-6/12">
                                        <x-admin.forms.input
                                            label="Minuta"
                                            :id="''"
                                            :name="'minutes_home[]'"
                                        />
                                    </div>
                                    <div class="w-6/12">
                                        <x-admin.forms.select
                                            label="Akce"
                                            :id="''"
                                            :name="'actions_home[]'"
                                            :options="\App\enums\FootballActions::options()"
                                        />
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endif



                    <div class="mt-3">
                        <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="playerCount++; $refs.footBallHomePlayerContainer.appendChild($refs.footBallHomePlayerContainer.children[0].cloneNode(true))">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                        <button x-show="playerCount >= 2" type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(playerCount > 1) playerCount--; $refs.footBallHomePlayerContainer.removeChild($refs.footBallHomePlayerContainer.lastElementChild);">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
                    </div>
                </div>





                <h3 class="mt-4 font-bold">Venkovní tým</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="count_of_goals_away_team"
                                             id="count_of_goals_away_team"
                                             label="Počet gólů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::COUNT_OF_GOALS_AWAY_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="holding_the_ball_away_team"
                                             id="holding_the_ball_away_team"
                                             type="number"
                                             label="% držení míče"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::HOLDING_THE_BALL_AWAY_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_on_goal_away_team"
                                             id="number_of_shots_on_goal_away_team"
                                             type="number"
                                             label="Počet střel na bránu"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM->value) }}"
                        />
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_away_team"
                                             id="number_of_shots_away_team"
                                             type="number"
                                             label="Počet střel"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_SHOTS_AWAY_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_corner_away_team"
                                             id="number_of_corner_away_team"
                                             type="number"
                                             label="Počet rohových kopů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_CORNER_AWAY_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_offsides_away_team"
                                             id="number_of_offsides_away_team"
                                             type="number"
                                             label="Počet ofsajdů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_OFFSIDES_AWAY_TEAM->value) }}"
                        />
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_fouls_away_team"
                                             id="number_of_fouls_away_team"
                                             type="number"
                                             label="Počet faulů"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_FOULS_AWAY_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_red_cards_away_team"
                                             id="number_of_red_cards_away_team"
                                             type="number"
                                             label="Počet červených karet"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_RED_CARDS_AWAY_TEAM->value) }}"
                        />
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_yellow_cards_away_team"
                                             id="number_of_yellow_cards_away_team"
                                             type="number"
                                             label="Počet žlutých karet"
                                             value="{{ $game->getMeta(\App\enums\FootballParameters::NUMBER_OF_YELLOW_CARDS_AWAY_TEAM->value) }}"
                        />
                    </div>



                </div>
                <div class="w-6/12">
                    <x-admin.forms.select name="football_result_away_team"
                                          id="football_result_away_team"
                                          label="Výsledek hostující tým"
                                          :options="\App\enums\MatchResults::FootballOptions()"
                                          selected="{{ $game->getMeta('football_result_away_team')}}"

                    />
                </div>
                <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
                <div x-data="{ footballPlayerAwayCount: {{ $game->away_actions_count}} }">
                    @if(is_null($game->id))
                        <div  x-ref="awayFootballPlayerContainer">
                            <div class="flex flex-row gap-5">
                                <div class="w-6/12">
                                    <x-admin.forms.input
                                        label="Jméno hráče"
                                        :id="''"
                                        :name="'players_away[]'"
                                    />
                                </div>
                                <div class="w-6/12">
                                    <x-admin.forms.input
                                        label="Minuta"
                                        :id="''"
                                        :name="'minutes_away[]'"
                                    />
                                </div>
                                <div class="w-6/12">
                                    <x-admin.forms.select
                                        label="Akce"
                                        :id="''"
                                        :name="'actions_away[]'"
                                        :options="\App\enums\FootballActions::options()"
                                    />
                                </div>
                            </div>

                        </div>
                    @else
                        @if($sportName === 'Fotbal' && !is_null($game->getMeta(\App\enums\FootballParameters::ACTIONS_AWAY->value)))
                            <div x-ref="awayFootballPlayerContainer">
                            @foreach($game->getMeta(\App\enums\FootballParameters::ACTIONS_AWAY->value) as $key => $action)
                                @foreach($action as $minuteAction)
                                        <div class="flex flex-row gap-5" >
                                            <div class="w-6/12">
                                                <x-admin.forms.input
                                                    label="Jméno hráče"
                                                    :id="''"
                                                    :name="'players_away[]'"
                                                    value="{{ $minuteAction['player'] }}"
                                                />
                                            </div>
                                            <div class="w-6/12">
                                                <x-admin.forms.input
                                                    label="Minuta"
                                                    :id="''"
                                                    :name="'minutes_away[]'"
                                                    value="{{ $key }}"
                                                />
                                            </div>
                                            <div class="w-6/12">
                                                <x-admin.forms.select
                                                    label="Akce"
                                                    :id="''"
                                                    :name="'actions_away[]'"
                                                    :options="\App\enums\FootballActions::options()"
                                                    selected="{{ $minuteAction['action'] }}"
                                                />
                                            </div>
                                        </div>
                                @endforeach
                            @endforeach
                            </div>
                        @else
                            <div  x-ref="awayFootballPlayerContainer">
                                <div class="flex flex-row gap-5">
                                    <div class="w-6/12">
                                        <x-admin.forms.input
                                            label="Jméno hráče"
                                            :id="''"
                                            :name="'players_away[]'"
                                        />
                                    </div>
                                    <div class="w-6/12">
                                        <x-admin.forms.input
                                            label="Minuta"
                                            :id="''"
                                            :name="'minutes_away[]'"
                                        />
                                    </div>
                                    <div class="w-6/12">
                                        <x-admin.forms.select
                                            label="Akce"
                                            :id="''"
                                            :name="'actions_away[]'"
                                            :options="\App\enums\FootballActions::options()"
                                        />
                                    </div>
                                </div>

                            </div>
                        @endif

                    @endif

                    <div class="mt-3">
                        <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="footballPlayerAwayCount++; $refs.awayFootballPlayerContainer.appendChild($refs.awayFootballPlayerContainer.children[0].cloneNode(true))">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                        <button x-show="footballPlayerAwayCount >= 2" type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(footballPlayerAwayCount > 1) footballPlayerAwayCount--; $refs.awayFootballPlayerContainer.removeChild($refs.awayFootballPlayerContainer.lastElementChild);">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div x-show="$wire.sportName === 'Hokej'">
            <h3 class="mt-4 font-bold">Domácí tým</h3>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_count_of_goals_home_team"
                                         id="hockey_count_of_goals"
                                         type="number"
                                         label="Počet gólů"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_COUNT_OF_GOALS_HOME_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_shooting_success_home_team"
                                         id="hockey_shooting_success_home_team"
                                         type="number"
                                         label="% ůspěšnost střelby"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_SHOOTING_SUCCESS_HOME_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_shots_on_goal_home_team"
                                         id="hockey_number_of_shots_on_goal_home_team"
                                         type="number"
                                         label="Počet střel na bránu"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_HOME_TEAM->value) }}"
                    />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_shots_home_team"
                                         id="hockey_number_of_shots_home_team"
                                         type="number"
                                         label="Počet střel"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_HOME_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_exclusion_home_team"
                                         id="hockey_number_of_exclusion_home_team"
                                         label="Počet vyloučení"
                                         type="number"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_EXCLUSION_HOME_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_goalkeeper_interventions_home_team"
                                         id="hockey_number_of_goalkeeper_interventions_home_team"
                                         label="Zásahy brankářů"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_HOME_TEAM->value) }}"
                    />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_blocked_shots_home_team"
                                         id="hockey_number_of_blocked_shots_home_team"
                                         type="number"
                                         label="Zblokované střely"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BLOCKED_SHOTS_HOME_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_power_play_goals_home_team"
                                         id="hockey_number_of_power_play_goals_home_team"
                                         type="number"
                                         label="Góly v přesilovce"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_HOME_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_buly_won_home_team"
                                         id="hockey_number_of_buly_won_home_team"
                                         type="number"
                                         label="Vyhraná buly"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BULY_WON_HOME_TEAM->value) }}"
                    />
                </div>
            </div>

            <div class="w-6/12">
                <x-admin.forms.select name="hockey_result_home_team"
                                      id="hockey_result_home_team"
                                      label="Výsledek domácí tým"
                                      :options="\App\enums\MatchResults::hockeyOptions()"
                                      selected="{{ $game->getMeta('hockey_result_home_team')}}"
                />
            </div>

           <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
            <div x-data="{ hockeyPlayerHomeCount: {{ $game->hockey_home_actions_count}} }">
                @if(is_null($game->id))
                    <div x-ref="hockeyPlayersHomeContainer">
                        <div class="flex flex-row gap-5">
                            <div class="w-6/12">
                                <x-admin.forms.input
                                    label="Jméno hráče"
                                    :id="''"
                                    :name="'hockey_players_home[]'"
                                />
                            </div>
                            <div class="w-6/12">
                                <x-admin.forms.input
                                    label="Minuta"
                                    :id="''"
                                    :name="'hockey_minutes_home[]'"
                                />
                            </div>
                            <div class="w-6/12">
                                <x-admin.forms.select
                                    label="Akce"
                                    :id="''"
                                    :name="'hockey_actions_home[]'"
                                    :options="\App\enums\HockeyActions::options()"
                                />
                            </div>
                        </div>

                    </div>
                @else
                    @if($sportName === 'Hokej' && !is_null($game->getMeta(\App\enums\HockeyParameters::HOCKEY_ACTIONS_HOME->value)))
                        <div x-ref="hockeyPlayersHomeContainer">
                    @foreach($game->getMeta(\App\enums\HockeyParameters::HOCKEY_ACTIONS_HOME->value) as $key => $action)
                        @foreach($action as $minuteAction)
                               <div class="flex flex-row gap-5">
                                   <div class="w-6/12">
                                       <x-admin.forms.input
                                           label="Jméno hráče"
                                           :id="''"
                                           :name="'hockey_players_home[]'"
                                           value="{{ $minuteAction['player'] }}"
                                       />
                                   </div>
                                   <div class="w-6/12">
                                       <x-admin.forms.input
                                           label="Minuta"
                                           :id="''"
                                           :name="'hockey_minutes_home[]'"
                                           value="{{ $key }}"
                                       />
                                   </div>
                                   <div class="w-6/12">
                                       <x-admin.forms.select
                                           label="Akce"
                                           :id="''"
                                           :name="'hockey_actions_home[]'"
                                           :options="\App\enums\HockeyActions::options()"
                                           selected="{{ $minuteAction['action'] }}"
                                       />
                                   </div>
                               </div>

                        @endforeach
                    @endforeach
                        </div>
                    @else
                        <div x-ref="hockeyPlayersHomeContainer">
                            <div class="flex flex-row gap-5">
                                <div class="w-6/12">
                                    <x-admin.forms.input
                                        label="Jméno hráče"
                                        :id="''"
                                        :name="'hockey_players_home[]'"
                                    />
                                </div>
                                <div class="w-6/12">
                                    <x-admin.forms.input
                                        label="Minuta"
                                        :id="''"
                                        :name="'hockey_minutes_home[]'"
                                    />
                                </div>
                                <div class="w-6/12">
                                    <x-admin.forms.select
                                        label="Akce"
                                        :id="''"
                                        :name="'hockey_actions_home[]'"
                                        :options="\App\enums\HockeyActions::options()"
                                    />
                                </div>
                            </div>

                        </div>
                    @endif
                @endif
                <div class="mt-3">
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="hockeyPlayerHomeCount++; $refs.hockeyPlayersHomeContainer.appendChild($refs.hockeyPlayersHomeContainer.children[0].cloneNode(true))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <button x-show="hockeyPlayerHomeCount >= 2" type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(hockeyPlayerHomeCount > 1) hockeyPlayerHomeCount--; $refs.hockeyPlayersHomeContainer.removeChild($refs.hockeyPlayersHomeContainer.lastElementChild);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                </div>
            </div>

            <h3 class="mt-4 font-bold">Venkovní tým</h3>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_count_of_goals_away_team"
                                         id="hockey_count_of_goals_away_team"
                                         type="number"
                                         label="Počet gólů"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_COUNT_OF_GOALS_AWAY_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_shooting_success_away_team"
                                         id="hockey_shooting_success_away_team"
                                         label="% ůspěšnost střelby"
                                         type="number"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_SHOOTING_SUCCESS_AWAY_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_shots_on_goal_away_team"
                                         id="hockey_number_of_shots_on_goal_away_team"
                                         type="number"
                                         label="Počet střel na bránu"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_ON_GOAL_AWAY_TEAM->value) }}"
                    />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_shots_away_team"
                                         id="hockey_number_of_shots_away_team"
                                         type="number"
                                         label="Počet střel"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_SHOTS_AWAY_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_exclusion_away_team"
                                         id="hockey_number_of_exclusion_away_team"
                                         type="number"
                                         label="Počet vyloučení"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_EXCLUSION_AWAY_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_goalkeeper_interventions_away_team"
                                         id="hockey_number_of_goalkeeper_interventions_away_team"
                                         label="Zásahy brankářů"
                                         type="number"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_GOALKEEPER_INTERVENTIONS_AWAY_TEAM->value) }}"
                    />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_blocked_shots_away_team"
                                         id="hockey_number_of_blocked_shots_away_team"
                                         label="Zblokované střely"
                                         type="number"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BLOCKED_SHOTS_AWAY_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_power_play_goals_away_team"
                                         id="hockey_number_of_power_play_goals_away_team"
                                         type="number"
                                         label="Góly v přesilovce"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_POWER_PLAY_GOALS_AWAY_TEAM->value) }}"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="hockey_number_of_buly_won_away_team"
                                         id="hockey_number_of_buly_won_away_team"
                                         label="Vyhraná buly"
                                         type="number"
                                         value="{{ $game->getMeta(\App\enums\HockeyParameters::HOCKEY_NUMBER_OF_BULY_WON_AWAY_TEAM->value) }}"
                    />
                </div>
            </div>

            <div class="w-6/12">
                <x-admin.forms.select name="hockey_result_away_team"
                                      id="hockey_result_away_team"
                                      label="Výsledek hostující tým"
                                      :options="\App\enums\MatchResults::hockeyOptions()"
                                      selected="{{ $game->getMeta('hockey_result_home_team')}}"
                />
            </div>
            <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>

            <div x-data="{ hockeyPlayerAwayCount: {{ $game->hockey_away_actions_count}} }">
                @if(is_null($game->id))
                    <div x-ref="hockeyAwayPlayersContainer">
                        <div class="flex flex-row gap-5">
                            <div class="w-6/12">
                                <x-admin.forms.input
                                    label="Jméno hráče"
                                    :id="''"
                                    :name="'hockey_players_away[]'"
                                />
                            </div>
                            <div class="w-6/12">
                                <x-admin.forms.input
                                    label="Minuta"
                                    :id="''"
                                    :name="'hockey_minutes_away[]'"
                                />
                            </div>
                            <div class="w-6/12">
                                <x-admin.forms.select
                                    label="Akce"
                                    :id="''"
                                    :name="'hockey_actions_away[]'"
                                    :options="\App\enums\HockeyActions::options()"
                                />
                            </div>
                        </div>

                    </div>
                @else
               @if($sportName === 'Hokej' && !is_null($game->getMeta(\App\enums\HockeyParameters::HOCKEY_ACTIONS_AWAY->value)))
                        <div x-ref="hockeyAwayPlayersContainer">
                    @foreach($game->getMeta(\App\enums\HockeyParameters::HOCKEY_ACTIONS_AWAY->value) as $key => $action)
                        @foreach($action as $minuteAction)

                                <div class="flex flex-row gap-5">
                                    <div class="w-6/12">
                                        <x-admin.forms.input
                                            label="Jméno hráče"
                                            :id="''"
                                            :name="'hockey_players_away[]'"
                                            value="{{ $minuteAction['player'] }}"
                                        />
                                    </div>
                                    <div class="w-6/12">
                                        <x-admin.forms.input
                                            label="Minuta"
                                            :id="''"
                                            :name="'hockey_minutes_away[]'"
                                            value="{{ $key }}"
                                        />
                                    </div>
                                    <div class="w-6/12">
                                        <x-admin.forms.select
                                            label="Akce"
                                            :id="''"
                                            :name="'hockey_actions_away[]'"
                                            :options="\App\enums\HockeyActions::options()"
                                            selected="{{ $minuteAction['action'] }}"
                                        />
                                    </div>
                                </div>

                        @endforeach
                    @endforeach
                        </div>
                    @else
                        <div x-ref="hockeyAwayPlayersContainer">
                            <div class="flex flex-row gap-5">
                                <div class="w-6/12">
                                    <x-admin.forms.input
                                        label="Jméno hráče"
                                        :id="''"
                                        :name="'hockey_players_away[]'"
                                    />
                                </div>
                                <div class="w-6/12">
                                    <x-admin.forms.input
                                        label="Minuta"
                                        :id="''"
                                        :name="'hockey_minutes_away[]'"
                                    />
                                </div>
                                <div class="w-6/12">
                                    <x-admin.forms.select
                                        label="Akce"
                                        :id="''"
                                        :name="'hockey_actions_away[]'"
                                        :options="\App\enums\HockeyActions::options()"
                                    />
                                </div>
                            </div>

                        </div>
                    @endif
                @endif
                <div class="mt-3">
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="hockeyPlayerAwayCount++; $refs.hockeyAwayPlayersContainer.appendChild($refs.hockeyAwayPlayersContainer.children[0].cloneNode(true))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <button x-show="hockeyPlayerAwayCount >= 2" type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(hockeyPlayerAwayCount > 1) hockeyPlayerAwayCount--;$refs.hockeyAwayPlayersContainer.removeChild($refs.hockeyAwayPlayersContainer.lastElementChild);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

</div>
</div>
