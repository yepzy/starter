<?php

namespace Database\Factories\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class LibraryMediaFileFactory extends Factory
{
    /** @var string */
    protected $model = LibraryMediaFile::class;

    protected static ?Collection $categories = null;

    protected array $media = ['audio.mp3', 'file.ods', 'file.pdf', 'image.jpg', 'video.mp4'];

    public function definition(): array
    {
        return [
            'name' => [
                'fr' => Str::title($this->faker->word),
                'en' => Str::title($this->faker->word),
            ],
        ];
    }

    public function withCategory(): self
    {
        return $this->afterMaking(function (LibraryMediaFile $file) {
            self::$categories = self::$categories ?: LibraryMediaCategory::get();
            $file->category_id = self::$categories->random(1)->first()->id;
        });
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $mediaPath = $this->media[array_rand($this->media, 1)];
            $file->addMedia(database_path('seeders/files/library-media/' . $mediaPath))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }
}
