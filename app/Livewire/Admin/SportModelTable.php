<?php

namespace App\Livewire\Admin;

use App\Modules\Sports\Models\Sport;
use Livewire\Component;

class SportModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.sport-model-table';

    protected string $model = Sport::class;

}
