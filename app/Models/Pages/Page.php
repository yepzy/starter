<?php

namespace App\Models\Pages;

use App\Models\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements HasMedia, HasBrickables
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;
    use HasBrickablesTrait;
    use HasSeoMeta;

    public array $translatable = ['slug', 'nav_title'];

    /** @var string */
    protected $table = 'pages';

    /** @var array */
    protected $fillable = ['unique_key', 'nav_title', 'slug', 'active'];

    /** @var array */
    protected $casts = ['active' => 'boolean'];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->registerSeoMetaMediaCollection();
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->format('webp');
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     * @param string|null $field
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return multilingual() && $field
            ? self::where($field . '->' . app()->getLocale(), $value)->first()
            : parent::resolveRouteBinding($value, $field);
    }
}
