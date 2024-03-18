<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SeasonModelTable extends AbstractModelTable
{
    protected string $model = Season::class;

    protected string $view = 'livewire.admin.season-model-table';

}