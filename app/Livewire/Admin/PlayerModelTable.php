<?php

namespace App\Livewire\Admin;

use App\Modules\Players\Models\Player;
use Livewire\Component;

class PlayerModelTable extends AbstractModelTable
{
    protected string $model = Player::class;

    protected string $view = 'livewire.admin.player-model-table';
}
