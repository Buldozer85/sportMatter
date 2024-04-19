<?php

namespace Database\Factories;

use App\Modules\Countries\Models\Country;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LeagueFactory extends Factory
{
    protected $model = League::class;

    public function definition(): array
    {
        return [
            'association' => $this->faker->word(),
            'name' => $this->faker->name(),
            'country_id' => Country::query()->inRandomOrder()->first()->id,
            'sport_id' => Sport::query()->inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
