<?php

namespace App\Models\Brickables;

use Okipa\LaravelBrickables\Models\Brick;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CarouselBrick extends Brick implements HasMedia
{
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slides')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('containerized')
                    ->fit(Manipulations::FIT_CROP, 1110, 400)
                    ->withResponsiveImages()
                    ->keepOriginalImageFormat()
                    ->nonQueued();
                $this->addMediaConversion('full')
                    ->fit(Manipulations::FIT_CROP, 2560, 700)
                    ->withResponsiveImages()
                    ->keepOriginalImageFormat()
                    ->nonQueued();
            });
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }
}