<?php

use App\Models\HomePage;
use Faker\Factory;
use Illuminate\Database\Seeder;

class HomePageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(config('app.faker_locale'));
        $homePage = (new HomePage)->create([
            'title'            => 'Accueil',
            'description'      => $faker->text(),
        ]);
        $homePage->setMeta('meta_title', 'Accueil');
        $homePage->setMeta('meta_description', $faker->text(150));
    }
}
