<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TitleH1 extends Brickable
{
    /** @inheritDoc */
    protected function setStoreValidationRules(): array
    {
        return localizeRules(['title' => ['required', 'string']]);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        return localizeRules(['title' => ['required', 'string']]);
    }
}
