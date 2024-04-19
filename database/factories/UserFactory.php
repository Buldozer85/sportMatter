<?php

namespace Database\Factories;

use App\enums\Role;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */

    protected static ?string $password = '123456qQ';

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'password' => static::$password ??= Hash::make('password'),
            'access' => fake()->randomElement([Role::USER, Role::EDITOR, Role::ADMINISTRATOR, Role::SUPER_ADMINISTRATOR]),
            'created_at' => fake()->dateTime(),
        ];
    }
}
