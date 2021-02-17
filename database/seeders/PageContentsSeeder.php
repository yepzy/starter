<?php

namespace Database\Seeders;

use App\Models\Pages\PageContent;
use App\Models\Pages\TitleDescriptionPageContent;
use Illuminate\Database\Seeder;

class PageContentsSeeder extends Seeder
{
    public function run(): void
    {
        PageContent::factory()->home()->withBricks()->withSeoMeta()->create();
        TitleDescriptionPageContent::factory()->news()->withBricks()->withSeoMeta()->create();
        TitleDescriptionPageContent::factory()->contact()->withBricks()->withSeoMeta()->create();
    }
}
