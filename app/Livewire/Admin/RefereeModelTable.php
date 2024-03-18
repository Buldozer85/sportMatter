<?php

namespace App\Livewire\Admin;

use App\Modules\Players\Models\Referee;
use Livewire\Component;

class RefereeModelTable extends AbstractModelTable
{
    protected string $model = Referee::class;

    protected string $view = 'livewire.admin.referee-model-table';
}
