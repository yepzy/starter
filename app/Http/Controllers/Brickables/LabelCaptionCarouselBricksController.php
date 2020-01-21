<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;

class LabelCaptionCarouselBricksController extends BricksController
{
    /** @inheritDoc */
    protected function stored(Request $request, Brick $brick): void
    {
        $slide = $request->file('slide');
        $brick->addMedia($slide->getRealPath())
            ->setFileName($slide->getClientOriginalName())
            ->withCustomProperties([
                'label' => $request->label,
                'caption' => $request->caption,
            ])
            ->toMediaCollection('bricks');
    }

    /** @inheritDoc */
    protected function updated(Request $request, Brick $brick): void
    {
        if ($slide = $request->file('slide')) {
            $brick->addMedia($slide->getRealPath())
                ->setFileName($slide->getClientOriginalName())
                ->withCustomProperties([
                    'label' => $request->label,
                    'caption' => $request->caption,
                ])
                ->toMediaCollection('bricks');
        }
    }
}
