<?php

use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        (new NewsCategory)->create(['name' => ['fr' => 'Apps Web', 'en' => 'Web apps']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Apps mobiles', 'en' => 'Mobile apps']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Site vitrine', 'en' => 'Showcase site']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Site catalogue', 'en' => 'Catalog site']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Identité visuelle', 'en' => 'Visual identity']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Graphisme', 'en' => 'Graphism']]);
    }
}
