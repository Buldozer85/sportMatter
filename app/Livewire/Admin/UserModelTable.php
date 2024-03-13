<?php

namespace App\Livewire\Admin;

use App\Modules\Users\Models\User;
use Livewire\Component;

class UserModelTable extends AbstractModelTable
{
   protected string $model = User::class;

   protected string $view = "livewire.admin.user-model-table";
}
