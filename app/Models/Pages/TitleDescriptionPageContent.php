<?php

namespace App\Models\Pages;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;

class TitleDescriptionPageContent extends PageContent
{
    public array $brickables = [
        'can_only_handle' => [
            TitleH1::class,
            OneTextColumn::class
        ],
        'number_of_bricks' => [
            TitleH1::class => ['min' => 1, 'max' => 1],
            OneTextColumn::class => ['max' => 1],
        ],
    ];
}
