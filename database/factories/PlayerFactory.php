<?php

namespace Database\Factories;

use App\Modules\Countries\Models\Country;
use App\Modules\Players\Models\Player;
use App\Modules\Teams\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birthdate' => Carbon::now(),
            'country_id' => Country::query()->inRandomOrder()->first(),
            'team_id' => Team::query()->inRandomOrder()->first(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
