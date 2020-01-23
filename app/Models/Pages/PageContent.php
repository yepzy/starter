<?php

namespace App\Models\Pages;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Metable;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;

class PageContent extends Metable implements HasBrickables
{
    use HasBrickablesTrait;

    protected $singleBrick = [
        TitleH1::class,
        OneTextColumn::class
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug'];
}
