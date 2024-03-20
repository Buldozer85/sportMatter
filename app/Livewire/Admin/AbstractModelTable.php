<?php

namespace App\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

abstract class AbstractModelTable extends Component
{
    use WithPagination;

    protected string $model = Model::class;

    protected int $perPage = 25;

    protected string $view = '';

    protected function basicQuery(): Builder
    {
        return $this->model::query();
    }

    protected function query(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->basicQuery()->paginate($this->perPage);
    }

    public function render()
    {
        $data = $this->query();

        return view($this->view)->with(['data' => $data]);
    }
}
