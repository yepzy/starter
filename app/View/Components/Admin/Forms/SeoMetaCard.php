<?php

namespace App\View\Components\Admin\Forms;

use App\Models\Abstracts\Seo;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoMetaCard extends Component
{
    public ?Seo $model;

    public function __construct(?Seo $model)
    {
        $this->model = $model;
    }

    public function render(): View
    {
        return view('components.admin.forms.seo-meta-card');
    }
}
