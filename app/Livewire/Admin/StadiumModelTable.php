<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class StadiumModelTable extends AbstractModelTable
{
    protected string $model = Stadium::class;

    protected string $view = 'livewire.admin.stadium-model-table';

}
