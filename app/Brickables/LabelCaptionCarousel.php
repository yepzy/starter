<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\LabelCaptionCarouselBricksController;
use App\Http\Requests\Request;
use App\Models\Brickables\LabelCaptionCarouselBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class LabelCaptionCarousel extends Brickable
{
    /** @inheritDoc */
    protected function setBrickModelClass(): string
    {
        return LabelCaptionCarouselBrick::class;
    }

    /** @inheritDoc */
    protected function setBricksControllerClass(): string
    {
        return LabelCaptionCarouselBricksController::class;
    }

    /** @inheritDoc */
    protected function setStoreValidationRules(): array
    {
        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $model */
        $model = $this->getBrickModel();
        $rules = [
            'slide' => array_merge(['required'], $model->validationConstraints('bricks')),
        ];
        $localizedRules = (new Request)->localizeRules([
            'label' => ['required', 'string', 'max:75'],
            'caption' => ['required', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $model */
        $model = $this->getBrickModel();
        $rules = [
            'slide' => $model->validationConstraints('bricks'),
        ];
        $localizedRules = (new Request)->localizeRules([
            'label' => ['required', 'string', 'max:75'],
            'caption' => ['required', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }
}
