<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        return view('components.admin.layouts.dashboard');
    }
}
