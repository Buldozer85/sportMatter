<?php

namespace App\View\Components\App\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public function render(): View
    {
        return view('components.app.forms.input');
    }
}
