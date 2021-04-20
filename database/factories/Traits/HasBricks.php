<?php

namespace Database\Factories\Traits;

use App\Brickables\Carousel;
use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Brickables\CarouselBrickSlide;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasBricks
{
    /**
     * @param array $carouselSlides
     *
     * @return $this
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Exception
     */
    public function withCarouselBrick(array $carouselSlides = []): self
    {
        return $this->afterCreating(function (Model $model) use ($carouselSlides) {
            $carouselBrick = $model->addBrick(Carousel::class, ['full_width' => true]);
            $slidesCount = $carouselSlides ? count($carouselSlides) : random_int(1, 3);
            $data = ['brick_id' => $carouselBrick->id, 'active' => true];
            for ($ii = 0; $ii <= $slidesCount; $ii++) {
                foreach (supportedLocaleKeys() as $localeKey) {
                    $data['label'][$localeKey] = data_get($carouselSlides, $ii . '.label.' . $localeKey)
                        ?: Str::title($this->faker->words(random_int(1, 3), true));
                    $data['caption'][$localeKey] = data_get($carouselSlides, $ii . '.caption.' . $localeKey)
                        ?: Str::title($this->faker->words(random_int(4, 7), true));
                }
                $slide = CarouselBrickSlide::create($data);
                $slide->addMedia(data_get($carouselSlides, $ii . '.image') ?: $this->faker->image(null, 2560, 700))
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        });
    }

    /**
     * @param array $title
     *
     * @return $this
     * @throws \Exception
     */
    public function withTitleH1Brick(array $title = []): self
    {
        return $this->afterCreating(function (Model $model) use ($title) {
            $data = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['title'][$localeKey] = data_get($title, $localeKey)
                    ?: Str::title($this->faker->words(random_int(1, 3), true));
            }
            $model->addBrick(TitleH1::class, $data);
        });
    }

    public function withOneTextColumnBrick(array $text = []): self
    {
        return $this->afterCreating(function (Model $model) use ($text) {
            $data = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['title'][$localeKey] = data_get($text, $localeKey) ?: $this->faker->realText(500);
            }
            $model->addBrick(OneTextColumn::class, $data);
        });
    }
}
