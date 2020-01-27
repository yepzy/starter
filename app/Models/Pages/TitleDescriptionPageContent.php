<?php

namespace App\Models\Pages;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;

class TitleDescriptionPageContent extends PageContent
{
    /** okipa/laravel-brickable package configuration. */
    public $brickables = [
        'canOnlyHandle' => [TitleH1::class, OneTextColumn::class],
        'limitedNumberOfBricks' => [TitleH1::class => 1, OneTextColumn::class],
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
