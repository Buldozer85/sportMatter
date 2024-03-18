<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class TeamModelTable extends AbstractModelTable
{
    protected string $model = Team::class;

    protected string $view = 'livewire.admin.team-model-table';
}
