<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;
use Spatie\MediaLibrary\Models\Media;

class CarouselBricksController extends BricksController
{
    /**
     * @param \Spatie\MediaLibrary\Models\Media $slide
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroySlide(Media $slide)
    {
        $brick = $slide->model;
        $model = $brick->model;
        $brickable = $brick->brickable;
        $name = $slide->getCustomProperty('label')[app()->getLocale()];
        $slide->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => $model->getReadableClassName(),
            'entity' => $brickable->getLabel(),
            'name' => $name,
        ]));
    }

    /** @inheritDoc */
    protected function stored(Request $request, Brick $brick): void
    {
        $this->addNewSlide($request, $brick);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     *
     * @return \Spatie\MediaLibrary\Models\Media
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function addNewSlide(Request $request, Brick $brick): Media
    {
        $image = $request->file('image');

        /** @var \Spatie\MediaLibrary\HasMedia\HasMediaTrait $brick */
        return $brick->addMedia($image->getRealPath())
            ->setFileName($image->getClientOriginalName())
            ->withCustomProperties([
                'label' => $request->label,
                'caption' => $request->caption,
            ])
            ->toMediaCollection('bricks');
    }

    /** @inheritDoc */
    protected function updated(Request $request, Brick $brick): void
    {
        if ($request->file('image')) {
            $this->addNewSlide($request, $brick);
        }
    }
}
