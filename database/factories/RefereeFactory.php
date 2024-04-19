<?php

namespace Database\Factories;

use App\Modules\Referees\Models\Referee;
use App\Modules\Sports\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RefereeFactory extends Factory
{
    protected $model = Referee::class;

    public function definition(): array
    {

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'sport_id' => Sport::query()->inRandomOrder()->first()->id,
        ];
    }
}
