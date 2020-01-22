<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\CarouselBricksController;
use App\Http\Requests\Request;
use App\Models\Brickables\CarouselBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Carousel extends Brickable
{
    /** @inheritDoc */
    protected function setBrickModelClass(): string
    {
        return CarouselBrick::class;
    }

    /** @inheritDoc */
    protected function setBricksControllerClass(): string
    {
        return CarouselBricksController::class;
    }

    /** @inheritDoc */
    protected function setStoreValidationRules(): array
    {
        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $model */
        $model = $this->getBrickModel();
        $rules = [
            'image' => array_merge(['required'], $model->validationConstraints('bricks')),
        ];
        $localizedRules = (new Request)->localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $model */
        $model = $this->getBrickModel();
        $rules = [
            'image' => array_merge(['required'], $model->validationConstraints('bricks')),
        ];
        $localizedRules = (new Request)->localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }
}
