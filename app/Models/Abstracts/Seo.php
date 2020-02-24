<?php

namespace App\Models\Abstracts;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

abstract class Seo extends Metable implements HasMedia
{
    use HasMediaTrait;

    protected array $seoTags = ['meta_title', 'meta_description'];

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('seo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('image')
                    ->fit(Manipulations::FIT_CROP, 1200, 600)
                    ->keepOriginalImageFormat();
            });
    }

    /**
     * Register the media conversions.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat();
    }

    /**
     * Save SEO meta from request.
     *
     * @param Request $request
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function saveSeoMetaFromRequest(Request $request): void
    {
        $this->saveMetaFromRequest($request, $this->seoTags);
        if ($request->has('remove_meta_image')) {
            $this->clearMediaCollection('seo');
        }
        if ($request->file('meta_image')) {
            $this->addMediaFromRequest('meta_image')->toMediaCollection('seo');
        }
    }

    /**
     * Save SEO meta for model from given array.
     *
     * @param array $values
     */
    public function saveSeoMeta(array $values): void
    {
        foreach ($this->seoTags as $tag) {
            if ($this->hasMeta($tag)) {
                $this->removeMeta($tag);
            }
            if (! empty(data_get($values, $tag))) {
                $this->setMeta($tag, data_get($values, $tag));
            }
        }
    }

    /**
     * Display SEO meta in the HTML head from model.
     */
    public function displaySeoMeta(): void
    {
        SEOTools::setTitle($this->getMeta('meta_title'));
        SEOTools::setDescription($this->getMeta('meta_description'));
        $metaImage = $this->getFirstMedia('seo');
        if ($metaImage) {
            SeoTools::addImages([$metaImage->getFullUrl('image')]);
        }
    }
}
