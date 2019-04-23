<?php

namespace App\Models;

use Okipa\MediaLibraryExtension\HasMedia\HasMedia;
use Okipa\MediaLibraryExtension\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;

class NewsArticle extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'description',
        'active',
        'published_at',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
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
        $this->addMediaCollection('illustration')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('cover')
                    ->fit(Manipulations::FIT_CROP, 1140, 500)
                    ->withResponsiveImages()
                    ->keepOriginalImageFormat()
                    ->nonQueued();
                $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 350, 250)
                    ->keepOriginalImageFormat()
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
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    // relationships ***************************************************************************************************

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_article_category')->withTimestamps();
    }

    // custom attributes ***********************************************************************************************

    /**
     * @return mixed
     */
    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }
}
