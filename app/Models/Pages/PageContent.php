<?php

namespace App\Models\Pages;

use App\Brickables\Carousel;
use App\Brickables\TitleH1;
use App\Models\Abstracts\Seo;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;

class PageContent extends Seo implements HasBrickables
{
    use HasBrickablesTrait;

    public array $brickables = [
        'number_of_bricks' => [
            TitleH1::class => ['min' => 1, 'max' => 1],
            Carousel::class => ['max' => 1],
        ],
    ];

    /** @var string $table */
    protected $table = 'page_contents';

    /** @var array $fillable */
    protected $fillable = ['unique_key'];
}
