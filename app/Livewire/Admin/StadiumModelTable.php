<?php

namespace App\Livewire\Admin;

use App\Modules\Stadiums\Models\Stadium;
use Livewire\Component;

class StadiumModelTable extends AbstractModelTable
{
    protected string $model = Stadium::class;

    protected string $view = 'livewire.admin.stadium-model-table';

}
