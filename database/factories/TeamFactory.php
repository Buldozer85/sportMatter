<?php

namespace Database\Factories;

use App\Modules\Leagues\Models\League;
use App\Modules\Stadiums\Models\Stadium;
use App\Modules\Teams\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'short_name' => mb_substr($name ,0 , 3),
            'league_id' => League::query()->inRandomOrder()->first()->id,
            'stadium_id' => Stadium::query()->inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
