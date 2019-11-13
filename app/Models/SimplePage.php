<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vkovic\LaravelModelMeta\Models\Traits\HasMetadata;

class SimplePage extends Model
{
    use HasMetadata;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'simple_pages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'url',
        'description',
        'active',
    ];
}
