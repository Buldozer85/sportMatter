<?php

namespace Database\Factories;

use App\Modules\Leagues\Models\League;
use App\Modules\Seasons\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition(): array
    {
        $yearStart = Carbon::createFromDate(fake()->dateTimeBetween("-5 years"));

        return [
            'yearStart' => $yearStart->format('Y-m-d'),
            'yearEnd' => fake()->dateTimeBetween($yearStart->toDateTimeString(), $yearStart->addYear()->toDateTimeString()),
            'league_id' => League::query()->inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
