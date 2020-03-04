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
        /** @var \Okipa\LaravelBrickables\Contracts\HasBrickables $model */
        $model = $brick->model;
        /** @var \Okipa\LaravelBrickables\Abstracts\Brickable $brickable */
        $brickable = $brick->brickable;
        $name = translatedData($slide->getCustomProperty('label'));
        $slide->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => $model->getReadableClassName(),
            'entity' => $brickable->getLabel(),
            'name' => $name,
        ]));
    }

    /**
     * @param \Spatie\MediaLibrary\Models\Media $slide
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveUpSlide(Media $slide)
    {
        $slides = $slide->model->getMedia('slides');
        $prev = $slides->where('order_column', '<', $slide->order_column)->values();
        $next = $slides->where('order_column', '>', $slide->order_column)->values();
        $itemToSwitchIndex = $next->count() ? $next->count() - 1 : $next->count();
        if ($next->has($itemToSwitchIndex)) {
            $prev->push($next->shift($itemToSwitchIndex));
        }
        $next->prepend($slide);
        $ids = [...$prev->pluck('id'), ...$next->pluck('id')];
        Media::setNewOrder($ids);

        return back();
    }

    /**
     * @param \Spatie\MediaLibrary\Models\Media $slide
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveDownSlide(Media $slide)
    {
        $slides = $slide->model->getMedia('slides');
        $prev = $slides->where('order_column', '<', $slide->order_column)->values();
        $next = $slides->where('order_column', '>', $slide->order_column)->values();
        $itemToSwitchIndex = $prev->count() - 1;
        if ($prev->has($itemToSwitchIndex)) {
            $next->prepend($prev->pull($itemToSwitchIndex));
        }
        $prev->push($slide);
        $ids = [...$prev->pluck('id'), ...$next->pluck('id')];
        Media::setNewOrder($ids);

        return back();
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

        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $brick */
        return $brick->addMedia($image->getRealPath())
            ->setFileName($image->getClientOriginalName())
            ->withCustomProperties(['label' => $request->label, 'caption' => $request->caption])
            ->toMediaCollection('slides');
    }

    /** @inheritDoc */
    protected function updated(Request $request, Brick $brick): void
    {
        if ($request->file('image')) {
            /** @var \App\Models\Brickables\CarouselFullWidthBrick $brick */
            $this->addNewSlide($request, $brick);
        }
    }
}
