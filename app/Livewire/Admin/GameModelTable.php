<?php

namespace App\Livewire\Admin;

use App\Modules\Games\Models\Game;

class GameModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.game-model-table';

    protected string $model = Game::class;
}
