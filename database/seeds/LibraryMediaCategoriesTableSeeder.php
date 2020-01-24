<?php

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Seeder;

class LibraryMediaCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        (new LibraryMediaCategory)->create(['name' => ['fr' => 'Accueil', 'en' => 'Home']]);
        (new LibraryMediaCategory)->create(['name' => ['fr' => 'Actualités', 'en' => 'News']]);
    }
}
