<?php

use App\Models\SimplePage;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SimplePagesTableSeeder extends Seeder
{
    protected $faker;
    protected $fakeText;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $this->faker = Factory::create(config('app.faker_locale'));
        $this->fakeText = <<<EOT
**Bold text.**

*Italic text.*

# Title 1
## Title 2
### Title 3
#### Title 4
##### Title 5
###### Title 6

> Quote.

Unordered list :
* Item 1.
* Item 2.

Ordered list :
1. Item 1.
2. Item 2.

[Link](http://www.google.com).
EOT;
        $this->createSimplePage('CGU et mentions légales', 'terms-of-service');
        $this->createSimplePage('Charte de respect de la vie privée - RGPD', 'rgpd');
    }

    /**
     * @param string $title
     * @param string $slug
     */
    protected function createSimplePage(string $title, string $slug): void
    {
        $simplePage = (new SimplePage)->create([
            'slug'        => $slug,
            'url'         => Str::slug($title),
            'title'       => $title,
            'description' => $this->fakeText,
            'active'      => true,
        ]);
        $simplePage->setMeta('meta_title', $title);
        $simplePage->setMeta('meta_description', $this->faker->text(150));
    }
}
