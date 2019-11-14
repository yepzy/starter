<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Metable\Metable;

class SimplePage extends Model
{
    use Metable;
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
