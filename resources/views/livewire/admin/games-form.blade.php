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
                />
            </div>

            <div class="w-6/12">
                <x-admin.forms.select
                    label="Sezóna"
                    id="season"
                    name="season"
                    :options="$seasonsOptions"
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
                />
            </div>
            <div class="w-6/12">
                <x-admin.forms.select
                    wire:model.live="selectedAway"
                    label="Venkovní tým/hráč"
                    id="away_team"
                    name="away_team"
                    :options="$awayTeamOptions"
                />
            </div>
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="w-6/12">
            <x-admin.forms.input type="date" name="date_of_match" id="date_of_match" label="Datum zápasu"/>
        </div>
        <div class="w-6/12">
            <x-admin.forms.input type="text" name="lap" id="lap" label="Kolo"/>
        </div>
    </div>
    <div class="flex flex-row gap-5">
        <div class="w-6/12">
            <x-admin.forms.select
                label="Adminstrátor zápasu"
                id="supervisor"
                name="supervisor"
                :options="$supervisorOptions"
            />
        </div>
    </div>
    <div x-data="{refereeCount: 1 }">
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
                        <x-admin.forms.input id="count_of_sets_first_player" name="count_of_sets_first_player"
                                             label="Počet vyhraných setů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_legs_first_player" name="count_of_legs_first_player"
                                             label="Počet vyhraných legů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="average_player_one" name="average_player_one"
                                             label="Průměr na 3 šipky 1.hráče"></x-admin.forms.input>
                    </div>
                </div>

                <h3 class="mt-4 font-bold">2. hráč</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_sets_second_player" name="count_of_sets_second_player"
                                             label="Počet vyhraných setů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="count_of_legs_second_player" name="count_of_legs_second_player"
                                             label="Počet vyhraných legů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input id="average_player_two" name="average_player_two"
                                             label="Průměr na 3 šipky"></x-admin.forms.input>
                    </div>
                </div>
            </div>

            <div x-show="$wire.sportName === 'Fotbal'">
                <h3 class="mt-4 font-bold">Domácí tým</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="count_of_goals_home_team" id="count_of_goals" label="Počet gólů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="holding_the_ball_home_team" id="holding_the_ball_home_team"
                                             label="% držení míče"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_on_goal_home_team" id="number_of_shots_on_goal_home_team"
                                             label="Počet střel na bránu"/>
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_home_team" id="number_of_shots_home_team"
                                             label="Počet střel"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_corner_home_team" id="number_of_corner_home_team"
                                             label="Počet rohových kopů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_offsides_home_team" id="number_of_offsides_home_team"
                                             label="Počet ofsajdů"/>
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_fouls_home_team" id="number_of_fouls_home_team"
                                             label="Počet faulů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_red_cards_home_team" id="number_of_red_cards_home_team"
                                             label="Počet červených karet"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_yellow_cards_home_team" id="number_of_yellow_cards_home_team"
                                             label="Počet žlutých karet"/>
                    </div>
                </div>

                <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
                <div x-data="{ playerCount: 1 }">
                    <template x-for="(index) in playerCount" :key="index">
                        <div class="flex flex-row gap-5" x-ref="teamContainer">
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
                    </template>

                    <div class="mt-3">
                        <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="playerCount++;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                        <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(playerCount > 1) playerCount--;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
                    </div>
                </div>





                <h3 class="mt-4 font-bold">Venkovní tým</h3>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="count_of_goals_away_team" id="count_of_goals_away_team"
                                             label="Počet gólů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="holding_the_ball_away_team" id="holding_the_ball_away_team"
                                             label="% držení míče"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_on_goal_away_team" id="number_of_shots_on_goal_away_team"
                                             label="Počet střel na bránu"/>
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_shots_away_team" id="number_of_shots_away_team"
                                             label="Počet střel"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_corner_away_team" id="number_of_corner_away_team"
                                             label="Počet rohových kopů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_offsides_away_team" id="number_of_offsides_away_team"
                                             label="Počet ofsajdů"/>
                    </div>
                </div>
                <div class="flex flex-row gap-5">
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_fouls_away_team" id="number_of_fouls_away_team"
                                             label="Počet faulů"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_red_cards_away_team" id="number_of_red_cards_away_team"
                                             label="Počet červených karet"/>
                    </div>
                    <div class="w-6/12">
                        <x-admin.forms.input name="number_of_yellow_cards_away_team" id="number_of_yellow_cards_away_team"
                                             label="Počet žlutých karet"/>
                    </div>
                </div>
                <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
                <div x-data="{ playerAwayCount: 1 }">
                    <template x-for="(index) in playerAwayCount" :key="index">
                        <div class="flex flex-row gap-5" x-ref="teamContainer">
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
                    </template>

                    <div class="mt-3">
                        <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="playerAwayCount++;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                        <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(playerAwayCount > 1) playerAwayCount--;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div x-show="selectedSport == 3">
            <h3 class="mt-4 font-bold">Domácí tým</h3>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="count_of_goals_home_team" id="count_of_goals" label="Počet gólů"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="shooting_success_home_team" id="shooting_success_home_team"
                                         label="% ůspěšnost střelby"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_shots_on_goal_home_team" id="number_of_shots_on_goal_home_team"
                                         label="Počet střel na bránu"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_shots_home_team" id="number_of_shots_home_team"
                                         label="Počet střel"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_exclusion_home_team" id="number_of_exclusion_home_team"
                                         label="Počet vyloučení"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_goalkeeper_interventions_home_team" id="number_of_goalkeeper_interventions_home_team"
                                         label="Zásahy brankářů"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_blocked_shots_home_team" id="number_of_blocked_shots_home_team"
                                         label="Zblokované střely"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_power_play_goals_home_team" id="number_of_power_play_goals_home_team"
                                         label="Góly v přesilovce"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_buly_won_cards_home_team" id="number_of_buly_won_cards_home_team"
                                         label="Vyhraná buly"/>
                </div>
            </div>

            <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
            <div x-data="{ playerAwayCount: 1 }">
                <template x-for="(index) in playerAwayCount" :key="index">
                    <div class="flex flex-row gap-5" x-ref="teamContainer">
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
                                :options="[
                        1 => 'Gol',
                        2 => 'Asistence',
                        3 => 'Žlutá karta',
                        4 => 'Červená karta',
                        5 => 'Střídání out',
                        6 => 'Střídání in',
                    ]"
                            />
                        </div>
                    </div>
                </template>

                <div class="mt-3">
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="playerAwayCount++;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(playerAwayCount > 1) playerAwayCount--;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                </div>
            </div>

            <h3 class="mt-4 font-bold">Venkovní tým</h3>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="count_of_goals_away_team" id="count_of_goals_away_team" label="Počet gólů"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="shooting_success_away_team" id="shooting_success_away_team"
                                         label="% ůspěšnost střelby"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_shots_on_goal_away_team" id="number_of_shots_on_goal_away_team"
                                         label="Počet střel na bránu"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_shots_away_team" id="number_of_shots_away_team"
                                         label="Počet střel"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_exclusion_away_team" id="number_of_exclusion_away_team"
                                         label="Počet vyloučení"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_goalkeeper_interventions_away_team" id="number_of_goalkeeper_interventions_away_team"
                                         label="Zásahy brankářů"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_blocked_shots_away_team" id="number_of_blocked_shots_away_team"
                                         label="Zblokované střely"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_power_play_goals_away_team" id="number_of_power_play_goals_away_team"
                                         label="Góly v přesilovce"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input name="number_of_buly_won_cards_away_team" id="number_of_buly_won_cards_away_team"
                                         label="Vyhraná buly"/>
                </div>
            </div>
            <h2 class="mt-2 font-bold">Zaznamenat akci k hráči</h2>
            <div x-data="{ playerAwayCount: 1 }">
                <template x-for="(index) in playerAwayCount" :key="index">
                    <div class="flex flex-row gap-5" x-ref="teamContainer">
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
                                :options="[
                        1 => 'Gol',
                        2 => 'Asistence',
                        3 => 'Žlutá karta',
                        4 => 'Červená karta',
                        5 => 'Střídání out',
                        6 => 'Střídání in',
                    ]"
                            />
                        </div>
                    </div>
                </template>

                <div class="mt-3">
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="playerAwayCount++;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="if(playerAwayCount > 1) playerAwayCount--;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

</div>
</div>
