<?php

namespace App\Models\Pages;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;

class TitleDescriptionPageContent extends PageContent
{
    public array $brickables = [
        'canOnlyHandle' => [
            TitleH1::class,
            OneTextColumn::class
        ],
        'numberOfBricks' => [
            TitleH1::class => ['min' => 1, 'max' => 1],
            OneTextColumn::class => ['max' => 1],
        ],
    ];
}
