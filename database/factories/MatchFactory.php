<?php

namespace Database\Factories;

use App\enums\DartsParameters;
use App\enums\MatchResults;
use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use App\Modules\Seasons\Models\Season;
use App\Modules\Teams\Models\Team;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MatchFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {

        $league = League::query()->whereHas('seasons')->inRandomOrder()->first();
        $season = $league->seasons()->inRandomOrder()->first();
        $home_team = $season->teams()->inRandomOrder()->first();
        $away_team = $season->teams()->where('teams.id', '!=', $home_team->id)->inRandomOrder()->first();

        $playerOneResult = fake()->randomElement([1, 5]);
        $secondPlayerResult = $playerOneResult === 1 ? 5 : 1;

        $holdingBallHomeTeam = fake()->randomFloat(1, 10, 100);

        $hockeyShootingSuccessHomeTeam = fake()->randomFloat(1, 0, 100);

        $footballResultHome = fake()->randomElement(MatchResults::FootballLabels());

        $awayFootballResult = match($footballResultHome) {
            MatchResults::TIDE->value => MatchResults::TIDE->value,
            MatchResults::WIN_ON_PENALTIES->value => MatchResults::LOSE_ON_PENALTIES->value,
            MatchResults::LOSE_ON_PENALTIES->value => MatchResults::WIN_ON_PENALTIES->value,
            MatchResults::LOSE->value => MatchResults::WIN->value,
            default => MatchResults::LOSE->value,
        };

        $hockeyResultHome = fake()->randomElement(MatchResults::hockeyLabels());

        $awayHockeyResult = match($footballResultHome) {
            MatchResults::TIDE->value => MatchResults::TIDE->value,
            MatchResults::WIN_ON_PENALTIES->value => MatchResults::LOSE_ON_PENALTIES->value,
            MatchResults::WIN_IN_EXTENSION->value => MatchResults::LOSE_IN_EXTENSION->value,
            MatchResults::LOSE_ON_PENALTIES->value => MatchResults::WIN_ON_PENALTIES->value,
            MatchResults::LOSE_IN_EXTENSION->value => MatchResults::WIN_IN_EXTENSION->value,
            MatchResults::LOSE->value => MatchResults::WIN->value,
            default => MatchResults::LOSE->value,
        };

        $actions = merge_arrays_preserve_keys([
            3 => [
                [
                    'player' => 'Pavele Novotný',
                    'action' => '1',
                    'type' => 'home'
                ],
                [
                    'player' => 'Rudolf Nový',
                    'action' => '2',
                    'type' => 'home'
                ]
            ],
            10 => [
                [
                    'player' => 'Tomáš Dvorský',
                    'action' => '1',
                    'type' => 'home'
                ]
            ],
            25 => [
                [ 'player' => 'Pepa Buřinka',
                    'action' => '5',
                    'type' => 'home'
                ]
            ],
            90 => [
                [
                    'player' => 'Budislav Kámen',
                    'action' => '5',
                    'type' => 'home'
                ]
            ]],
            [
                3 => [
                    [   'player' => 'Pavel Donbrý',
                        'action' => '1',
                        'type' => 'away'
                    ],
                    [
                        'player' => 'Rudolf Kori',
                        'action' => '2',
                        'type' => 'away'
                    ]
                ],
                10 => [
                    [
                        'player' => 'Tomáš Potěmkuch',
                        'action' => '1',
                        'type' => 'away'
                    ]
                ],
                55 => [
                    [
                        'player' => 'Pepa Buřinka',
                        'action' => '5',
                        'type' => 'away'
                    ]

                ]]);
        ksort($actions);

        $actionsHockey = merge_arrays_preserve_keys([
            2 => [
                [
                    'player' => 'Pavele Novotný',
                    'action' => '1',
                    'type' => 'home'
                ],
                [
                    'player' => 'Rudolf Nový',
                    'action' => '2',
                    'type' => 'home'
                ]
            ],
            10 => [
                [
                    'player' => 'Tomáš Dvorský',
                    'action' => '1',
                    'type' => 'home'
                ]
            ],
            25 => [
                [ 'player' => 'Pepa Buřinka',
                    'action' => '5',
                    'type' => 'home'
                ]
            ],
            60 => [
                [
                    'player' => 'Budislav Kámen',
                    'action' => '5',
                    'type' => 'home'
                ]
            ]],
            [
                3 => [
                    [   'player' => 'Pavel Donbrý',
                        'action' => '1',
                        'type' => 'away'
                    ],
                    [
                        'player' => 'Rudolf Kori',
                        'action' => '2',
                        'type' => 'away'
                    ]
                ],
                10 => [
                    [
                        'player' => 'Tomáš Potěmkuch',
                        'action' => '1',
                        'type' => 'away'
                    ]
                ],
                55 => [
                    [
                        'player' => 'Pepa Buřinka',
                        'action' => '5',
                        'type' => 'away'
                    ]

                ]]
        );
        ksort($actionsHockey);

        //$actionsHockey


        $parameters = match ($league->sport->name) {
            'Šipky' => [
                'count_of_sets_first_player' => fake()->numberBetween(0, 6),
                'count_of_legs_first_player' => fake()->numberBetween(0, 21),
                'average_first_player' => fake()->randomFloat(2, 25, 160),
                'count_of_sets_second_player' => fake()->numberBetween(0,6),
                'count_of_legs_second_player' => fake()->numberBetween(0, 21),
                'average_second_player' => fake()->randomFloat(2, 25, 160),
                'darts_result_first_player' => $playerOneResult,
                'darts_result_second_player' => $secondPlayerResult
            ],
            'Fotbal' => [
                'count_of_goals_home_team' => fake()->numberBetween(0, 15),
                'holding_the_ball_home_team' => $holdingBallHomeTeam,
                'number_of_shots_on_goal_home_team' => fake()->numberBetween(0, 30),
                'number_of_shots_home_team' => fake()->numberBetween(0, 40),
                'number_of_corner_home_team' => fake()->numberBetween(0, 15),
                'number_of_offsides_home_team' => fake()->numberBetween(0, 15),
                'number_of_fouls_home_team' => fake()->numberBetween(0, 15),
                'number_of_red_cards_home_team' => fake()->numberBetween(0, 5),
                'number_of_yellow_cards_home_team' => fake()->numberBetween(0, 7),
                'count_of_goals_away_team' => fake()->numberBetween(0, 15),
                'holding_the_ball_away_team' => 100 - $holdingBallHomeTeam,
                'number_of_shots_on_goal_away_team' => fake()->numberBetween(0, 30),
                'number_of_shots_away_team' => fake()->numberBetween(0, 40),
                'number_of_corner_away_team' => fake()->numberBetween(0, 15),
                'number_of_offsides_away_team' => fake()->numberBetween(0, 15),
                'number_of_fouls_away_team' => fake()->numberBetween(0, 15),
                'number_of_red_cards_away_team' => fake()->numberBetween(0, 5),
                'number_of_yellow_cards_away_team' => fake()->numberBetween(0, 7),
                'football_result_away_team' => $awayFootballResult,
                'football_result_home_team' => $footballResultHome,
                'actions_home' => [
                    3 => [
                        [
                            'player' => 'Pavele Novotný',
                            'action' => '1',
                            'type' => 'home'
                        ],
                        [
                            'player' => 'Rudolf Nový',
                            'action' => '2',
                            'type' => 'home'
                        ]
                    ],
                    10 => [
                        [
                            'player' => 'Tomáš Dvorský',
                            'action' => '1',
                            'type' => 'home'
                        ]
                    ],
                    25 => [
                        [ 'player' => 'Pepa Buřinka',
                            'action' => '5',
                            'type' => 'home'
                        ]
                    ],
                    90 => [
                        [
                            'player' => 'Budislav Kámen',
                            'action' => '5',
                            'type' => 'home'
                        ]
                    ]],
                'actions_away' => [
                    3 => [
                        [   'player' => 'Pavel Donbrý',
                            'action' => '1',
                            'type' => 'away'
                        ],
                        [
                            'player' => 'Rudolf Kori',
                            'action' => '2',
                            'type' => 'away'
                        ]
                    ],
                    10 => [
                        [
                            'player' => 'Tomáš Potěmkuch',
                            'action' => '1',
                            'type' => 'away'
                        ]
                    ],
                    55 => [
                        [
                            'player' => 'Pepa Buřinka',
                            'action' => '5',
                            'type' => 'away'
                        ]

                    ]],
                'actions' => $actions
            ],
            'Hokej' => [
                'hockey_count_of_goals_home_team' => fake()->numberBetween(0,12),
                'hockey_shooting_success_home_team' => $hockeyShootingSuccessHomeTeam,
                'hockey_number_of_shots_on_goal_home_team' => fake()->numberBetween(0,50),
                'hockey_number_of_shots_home_team' => fake()->numberBetween(0,60),
                'hockey_number_of_exclusion_home_team' => fake()->numberBetween(0,20),
                'hockey_number_of_goalkeeper_interventions_home_team' => fake()->numberBetween(0,40),
                'hockey_number_of_blocked_shots_home_team' => fake()->numberBetween(0,40),
                'hockey_number_of_power_play_goals_home_team' => fake()->numberBetween(0,3),
                'hockey_number_of_buly_won_home_team' => fake()->numberBetween(0,20),
                'hockey_count_of_goals_away_team' => fake()->numberBetween(0,12),
                'hockey_shooting_success_away_team' => fake()->randomFloat(1, 0, 100),
                'hockey_number_of_shots_on_goal_away_team' => fake()->numberBetween(0,50),
                'hockey_number_of_shots_away_team' => fake()->numberBetween(0,60),
                'hockey_number_of_exclusion_away_team' => fake()->numberBetween(0,12),
                'hockey_number_of_goalkeeper_interventions_away_team' => fake()->numberBetween(0,40),
                'hockey_number_of_blocked_shots_away_team' => fake()->numberBetween(0,60),
                'hockey_number_of_power_play_goals_away_team' => fake()->numberBetween(0,3),
                'hockey_number_of_buly_won_away_team' => fake()->numberBetween(0,20),
                'hockey_result_away_team' => $awayHockeyResult,
                'hockey_result_home_team' => $hockeyResultHome,
                'hockey_actions_home' => [
                    2 => [
                        [
                            'player' => 'Pavele Novotný',
                            'action' => '1',
                            'type' => 'home'
                        ],
                        [
                            'player' => 'Rudolf Nový',
                            'action' => '2',
                            'type' => 'home'
                        ]
                    ],
                    10 => [
                        [
                            'player' => 'Tomáš Dvorský',
                            'action' => '1',
                            'type' => 'home'
                        ]
                    ],
                    25 => [
                        [ 'player' => 'Pepa Buřinka',
                            'action' => '5',
                            'type' => 'home'
                        ]
                    ],
                    60 => [
                        [
                            'player' => 'Budislav Kámen',
                            'action' => '5',
                            'type' => 'home'
                        ]
                    ]],
                'hockey_actions_away' => [
                    3 => [
                        [   'player' => 'Pavel Donbrý',
                            'action' => '1',
                            'type' => 'away'
                        ],
                        [
                            'player' => 'Rudolf Kori',
                            'action' => '2',
                            'type' => 'away'
                        ]
                    ],
                    10 => [
                        [
                            'player' => 'Tomáš Potěmkuch',
                            'action' => '1',
                            'type' => 'away'
                        ]
                    ],
                    55 => [
                        [
                            'player' => 'Pepa Buřinka',
                            'action' => '5',
                            'type' => 'away'
                        ]

                    ]],
                'actions' => $actionsHockey
            ]
    };


        return [
            'date_of_match' => fake()->dateTimeBetween($season->yearStart->toDateTimeString(), $season->yearEnd->toDateTimeString()),
            'lap' => $this->faker->numberBetween(1, 60),
            'parameters' => json_encode($parameters),
            'supervisor_id' => User::query()->whereIn('access', ['admininistrator', 'superadministratr', 'editor'])->inRandomOrder()->first()->id,
            'away_team_id' => $away_team->id,
            'home_team_id' => $home_team->id,
            'season_id' => $season->id,
            'league_id' => $league->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
