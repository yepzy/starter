<?php

use Faker\Factory;
use App\Models\NewsArticle;
use App\Models\NewsCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class NewsTableSeeder extends Seeder
{
    protected $faker;
    protected $categories;
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
        $this->categories = $this->seedCategories();
        for ($ii = 1; $ii <= 5; $ii++) {
            $this->seedArticles($ii);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function seedCategories(): Collection
    {
        $seededCategories = new Collection();
        $categories = [
            'Cat1',
            'Cat2',
        ];
        foreach ($categories as $category) {
            $category = (new NewsCategory)->create(['name' => $category]);
            $seededCategories->push($category);
        }

        return $seededCategories;
    }

    /**
     * @param int $key
     *
     * @return void
     */
    protected function seedArticles(int $key): void
    {
        $images = ['seeds/files/news/article-2560-1440.jpg', 'seeds/files/news/article-2560-1769.jpg'];
        $this->createArticle(
            "Article #$key",
            $images[array_rand($images, 1)]
        );
    }

    /**
     * @param string $title
     * @param string $imageUrl
     */
    protected function createArticle(string $title, string $imageUrl): void
    {
        $article = (new NewsArticle)->create([
            'url'          => Str::slug($title),
            'title'        => $title,
            'description'  => $this->fakeText,
            'active'       => true,
            'published_at' => Carbon::now(),
        ]);
        $article->addMedia(database_path($imageUrl))
            ->preservingOriginal()
            ->toMediaCollection('illustrations');
        $categoryIds = $this->categories->random(rand(1, $this->categories->count() / 3))->pluck('id');
        $article->categories()->sync($categoryIds);
        $article->setMeta('meta_title', $title);
        $article->setMeta('meta_description', $this->faker->text(150));
    }
}
