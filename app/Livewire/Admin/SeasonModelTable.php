<?php

namespace App\Livewire\Admin;

use App\Modules\Seasons\Models\Season;
use Livewire\Component;

class SeasonModelTable extends AbstractModelTable
{
    protected string $model = Season::class;

    protected string $view = 'livewire.admin.season-model-table';

    public function delete(string $id)
    {
        /** @var Season $record */
        $record = $this->model::query()->find($id);

        $record->teams()->detach();

        $record->delete();
    }

}
