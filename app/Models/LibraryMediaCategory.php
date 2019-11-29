<?php

namespace App\Models;

class LibraryMediaCategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'library_media_categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libraryMedia()
    {
        return $this->belongsTo(LibraryMedia::class, 'category_id');
    }
}
