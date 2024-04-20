<?php

namespace App\Policies;

use App\enums\Role;
use App\Modules\Games\Models\Game;
use App\Modules\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Game $game): bool
    {
        return $game->supervisor_id === $user->id || $user->access !== Role::EDITOR;
    }

    public function create(User $user): bool
    {
        return  $user->access !== Role::EDITOR;
    }

    public function update(User $user, Game $game): bool
    {
        return $game->supervisor_id === $user->id || $user->access !== Role::EDITOR;
    }

    public function delete(User $user, Game $game): bool
    {
        return  $user->access !== Role::EDITOR;
    }

}
