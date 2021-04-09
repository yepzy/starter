<?php

namespace App\View\Components\Admin\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class SeoMetaCard extends Component
{
    public Model $model;

    public function __construct(?Model $model)
    {
        $this->model = $model;
    }

    public function render(): View
    {
        return view('components.admin.forms.seo-meta-card');
    }
}
