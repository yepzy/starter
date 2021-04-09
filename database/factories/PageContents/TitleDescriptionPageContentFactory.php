<?php

namespace Database\Factories\PageContents;

use App\Models\PageContents\TitleDescriptionPageContent;
use Database\Factories\Traits\HasBricks;
use Database\Factories\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\Factory;

class TitleDescriptionPageContentFactory extends Factory
{
    use HasSeoMeta;
    use HasBricks;

    /** @var string */
    protected $model = TitleDescriptionPageContent::class;

    public function definition(): array
    {
        return [];
    }

    public function news(): self
    {
        return $this->afterMaking(function (TitleDescriptionPageContent $content) {
            $content->unique_key = 'news_page_content';
        });
    }

    public function contact(): self
    {
        return $this->afterMaking(function (TitleDescriptionPageContent $content) {
            $content->unique_key = 'contact_page_content';
        });
    }
}
