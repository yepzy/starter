<?php

namespace App\Models\Brickables;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Okipa\LaravelBrickables\Models\Brick;

class CarouselBrick extends Brick
{
    public function slides(): HasMany
    {
        return $this->hasMany(CarouselBrickSlide::class, 'brick_id');
    }
}
