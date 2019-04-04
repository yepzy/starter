<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Okipa\MediaLibraryExtension\HasMedia\HasMedia;
use Okipa\MediaLibraryExtension\HasMedia\HasMediaTrait;

class Settings extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'phone_number',
        'location',
        'address',
        'zip_code',
        'city',
        'facebook',
        'instagram',
        'google_tag_manager',
    ];
    // media ***********************************************************************************************************

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('icon')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('front-mobile-header')
                    ->fit(Manipulations::FIT_CONTAIN, 70, 70)
                    ->keepOriginalImageFormat()
                    ->withResponsiveImages()
                    ->nonQueued();
                $this->addMediaConversion('admin-header')
                    ->fit(Manipulations::FIT_CONTAIN, 30, 30)
                    ->keepOriginalImageFormat()
                    ->nonQueued();
                $this->addMediaConversion('mail')
                    ->fit(Manipulations::FIT_CONTAIN, 50, 50)
                    ->keepOriginalImageFormat()
                    ->nonQueued();
                $this->addMediaConversion('auth')
                    ->fit(Manipulations::FIT_CONTAIN, 225, 225)
                    ->keepOriginalImageFormat()
                    ->withResponsiveImages()
                    ->nonQueued();
            });
    }

    /**
     * Register the media conversions.
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->crop(Manipulations::CROP_CENTER, 40, 40)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }
}
