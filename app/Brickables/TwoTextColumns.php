<?php

namespace App\Brickables;

use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextColumns extends Brickable
{
    /** @inheritDoc */
    protected function setStoreValidationRules(): array
    {
        return localizeRules([
            'text_left' => ['required', 'string'],
            'text_right' => ['required', 'string'],
        ]);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        return localizeRules([
            'text_left' => ['required', 'string'],
            'text_right' => ['required', 'string'],
        ]);
    }
}
