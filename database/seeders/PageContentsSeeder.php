<?php

namespace Database\Seeders;

use App\Models\PageContents\PageContent;
use App\Models\PageContents\TitleDescriptionPageContent;
use Illuminate\Database\Seeder;

class PageContentsSeeder extends Seeder
{
    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run(): void
    {
        PageContent::factory()->home()
            ->withCarouselBrick()
            ->withTitleH1Brick()
            ->withOneTextColumnBrick()
            ->withSeoMeta()
            ->create();
        TitleDescriptionPageContent::factory()
            ->news()
            ->withTitleH1Brick()
            ->withOneTextColumnBrick()
            ->withSeoMeta()
            ->create();
        TitleDescriptionPageContent::factory()
            ->contact()
            ->withTitleH1Brick()
            ->withOneTextColumnBrick()
            ->withSeoMeta()
            ->create();
    }
}
