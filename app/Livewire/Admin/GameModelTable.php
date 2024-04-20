<?php

namespace App\Livewire\Admin;

use App\enums\Role;
use App\Modules\Games\Models\Game;

class GameModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.game-model-table';

    protected string $model = Game::class;

    public function delete(string $id)
    {
        $game = Game::query()->find($id);

        $game->referees()->detach();

        $game->delete();
    }

    protected function query(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if(user()->access == Role::EDITOR) {
            return $this->basicQuery()->where('supervisor_id', '=' , user()->id)->paginate($this->perPage);
        }

        return $this->basicQuery()->paginate($this->perPage);
    }
}
