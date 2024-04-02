<?php

namespace App\Livewire\Admin;

use App\Modules\Countries\Models\Country;
use Livewire\Component;

class CountryModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.country-model-table';

    protected string $model = Country::class;

}
