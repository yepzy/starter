<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;

class HomeSlide extends Model implements HasMedia, Sortable
{
    use HasMediaTrait;
    use SortableTrait;
    public $sortable = [
        'order_column_name'  => 'position',
        'sort_when_creating' => true,
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'home_slides';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_page_id',
        'title',
        'description',
        'position',
        'active',
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
        $this->addMediaCollection('illustrations')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('cover')
                    ->fit(Manipulations::FIT_CROP, 2560, 500)
                    ->keepOriginalImageFormat();
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
            ->keepOriginalImageFormat();
    }

    // relationships ***************************************************************************************************

    public function homePage()
    {
        return $this->belongsTo(HomePage::class);
    }
}
