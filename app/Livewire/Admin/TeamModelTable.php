<?php

namespace App\Livewire\Admin;

use App\Modules\Teams\Models\Team;
use Livewire\Component;

class TeamModelTable extends AbstractModelTable
{
    protected string $model = Team::class;

    protected string $view = 'livewire.admin.team-model-table';
}
