<?php

namespace App\Livewire\Admin;

use App\Modules\Leagues\Models\League;

class LeagueModelTable extends AbstractModelTable
{
    protected string $model = League::class;

    protected string $view = 'livewire.admin.league-model-table';
}
