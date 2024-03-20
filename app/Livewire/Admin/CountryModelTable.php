<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CountryModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.country-model-table';

    protected string $model = Country::class;

}
