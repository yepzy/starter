<?php

use App\Models\HomePage;
use App\Models\HomeSlide;
use Faker\Factory;
use Illuminate\Database\Seeder;

class HomeSlidesTableSeeder extends Seeder
{
    protected $faker;
    protected $homePage;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create(config('app.faker_locale'));
        $this->homePage = (new HomePage)->firstOrFail();
        $this->createSlide(database_path('seeds/files/home/slide-1-2560-1769.jpg'));
        $this->createSlide(database_path('seeds/files/home/slide-2-2560-1896.jpg'));
    }

    /**
     * @param string $imagePath
     */
    protected function createSlide(string $imagePath): void
    {
        $slide = (new HomeSlide)->create([
            'home_page_id' => $this->homePage->id,
            'title'        => $this->faker->word(),
            'description'  => $this->faker->sentence(),
            'active'       => true,
        ]);
        $slide->addMedia($imagePath)->preservingOriginal()->toMediaCollection('illustrations');
    }
}
