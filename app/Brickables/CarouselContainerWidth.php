<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\CarouselBricksController;
use App\Models\Brickables\CarouselContainerWidthBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class CarouselContainerWidth extends Brickable
{
    /** @inheritDoc */
    protected function setBrickModelClass(): string
    {
        return CarouselContainerWidthBrick::class;
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
            'image' => array_merge(['required'], $model->validationRules('slides')),
        ];
        $localizedRules = localizeRules([
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
            'image' => array_merge(['required'], $model->validationRules('slides')),
        ];
        $localizedRules = localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }
}
