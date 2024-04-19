<?php

namespace Database\Factories;

use App\Modules\Countries\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        $name = $this->faker->country();

        return [
            'name' => $name,
            'short_name' => mb_substr($name, 0, 2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
