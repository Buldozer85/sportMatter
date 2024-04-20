<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\enums\Role;
use App\Modules\Countries\Models\Country;
use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use App\Modules\Players\Models\Player;
use App\Modules\Referees\Models\Referee;
use App\Modules\Seasons\Models\Season;
use App\Modules\Sports\Models\Sport;
use App\Modules\Stadiums\Models\Stadium;
use App\Modules\Teams\Models\Team;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->createUsers();
       $this->createSports();
       $this->createCountries();
       $this->createReferees();
       $this->createStadiums();
       $this->createLeagues();
       $this->createSeasons();
       $this->createPlayers();
       $this->createMatches();
    }

    private function createUsers(): void
    {
        $superAdmin = new User();
        $superAdmin->first_name = 'Admin';
        $superAdmin->last_name = 'Admin';
        $superAdmin->email = 'admin@admin.com';
        $superAdmin->password = Hash::make('123456qQ');
        $superAdmin->access = Role::SUPER_ADMINISTRATOR;
        $superAdmin->save();

        $admin = new User();
        $admin->first_name = 'Administrator';
        $admin->last_name = 'Administrator';
        $admin->email = 'admininistrator@admininistrator.com';
        $admin->password = Hash::make('123456qQ');
        $admin->access = Role::ADMINISTRATOR;
        $admin->save();

        $editor = new User();
        $editor->first_name = 'Editor';
        $editor->last_name = 'Editor';
        $editor->email = 'editor@editor.com';
        $editor->password = Hash::make('123456qQ');
        $editor->access = Role::EDITOR;
        $editor->save();

        $user = new User();
        $user->first_name = 'User';
        $user->last_name = 'User';
        $user->email = 'user@user.com';
        $user->password = Hash::make('123456qQ');
        $user->access = Role::USER;
        $user->save();

        User::factory(100)->create();
    }

    private function createSports(): void
    {
        if(is_null(Sport::query()->where('name', '=', 'Šipky')->first())) {
            Sport::query()->create(['name' => 'Šipky']);
        }

        if(is_null(Sport::query()->where('name', '=', 'Fotbal')->first())) {
            Sport::query()->create(['name' => 'Fotbal']);
        }

        if(is_null(Sport::query()->where('name', '=', 'Hokej')->first())) {
            Sport::query()->create(['name' => 'Hokej']);
        }

    }

    private function createCountries(): void
    {
        Country::factory(70)->create()->unique('name');
    }

    private function createReferees(): void
    {
        Referee::factory(60)->create();
    }

    private function createStadiums(): void
    {
        Stadium::factory(60)->create();
    }

    private function createLeagues(): void
    {
        League::factory(100)->create();
    }

    private function createSeasons(): void
    {
        Season::factory(50)->hasAttached(
            Team::factory(10)
                ->state(function (array $attributes, Season $season) {
                            return ['league_id' => $season->league->id];
                }
                ),
            ['points' => fake()->randomNumber(2)])->create();
    }

    private function createPlayers(): void
    {
        Player::factory(200)->create();
    }

    private function createMatches(): void
    {
        Game::factory(300)
            ->hasAttached(Referee::factory(3)
                ->state(function (array $attributes, Game $game) {
                    return [
                        'sport_id' => $game->league->sport->id
                    ];
                }))
            ->create();
    }
}
