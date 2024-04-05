<?php

namespace App\Livewire\Admin;

use App\Modules\Users\Models\User;
use Livewire\Component;

class UserModelTable extends AbstractModelTable
{
   protected string $model = User::class;

   protected string $view = 'livewire.admin.user-model-table';

   protected function query(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
   {
       return $this->basicQuery()->where('id', '!=', user()->id)->paginate($this->perPage);
   }
}
