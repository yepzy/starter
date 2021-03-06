<?php

namespace Database\Seeders;

use App\Models\News\NewsArticle;
use Illuminate\Database\Seeder;

class NewsArticlesSeeder extends Seeder
{
    public function run(): void
    {
        NewsArticle::factory()->withCategory()->withMedia()->count(5)->create();
    }
}
