<?php

namespace App\View\Components\Common\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notice extends Component
{
    public function render(): View
    {
        return view('components.common.forms.notice');
    }
}
