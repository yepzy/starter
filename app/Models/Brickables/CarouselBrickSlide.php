<?php

namespace App\Models\Brickables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class CarouselBrickSlide extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia, ExtendsMediaAbilities, SortableTrait, HasTranslations;

    public array $sortable = ['order_column_name' => 'position', 'sort_when_creating' => true];

    protected $table = 'carousel_brick_slides';

    protected $fillable = [
        'brick_id',
        'label',
        'caption',
        'position',
        'active',
    ];

    public array $translatable = ['label', 'caption'];

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
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
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
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

    public function brick(): BelongsTo
    {
        return $this->belongsTo(CarouselBrick::class, 'brick_id');
    }

    public function buildSortQuery(): Builder
    {
        return static::query()->where('brick_id', $this->brick->id);
    }
}