<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextColumns extends Brickable
{
    /** @inheritDoc */
    protected function setStoreValidationRules(): array
    {
        return (new Request)->localizeRules([
            'text_left' => ['required', 'string'],
            'text_right' => ['required', 'string'],
        ]);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        return (new Request)->localizeRules([
            'text_left' => ['required', 'string'],
            'text_right' => ['required', 'string'],
        ]);
    }
}
