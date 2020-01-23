<?php

use App\Models\News\NewsCategory;
use Faker\Factory;
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
        $this->faker = Factory::create('fr_EN');
        for ($ii = 1; $ii <= 5; $ii++) {
            $name = $this->faker->word();
            (new NewsCategory)->create([
                'name' => [
                    'fr' => $name . ' FR',
                    'en' => $name . ' EN',
                ],
            ]);
        }
    }
}
