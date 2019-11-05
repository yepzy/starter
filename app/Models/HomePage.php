<?php

namespace App\Models;

use Vkovic\LaravelModelMeta\Models\Traits\HasMetadata;

class HomePage extends Model
{
    use HasMetadata;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'home_page';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany(HomeSlide::class, 'home_page_id');
    }
}
