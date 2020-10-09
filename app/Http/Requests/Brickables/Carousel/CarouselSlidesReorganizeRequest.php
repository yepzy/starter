<?php

namespace App\Http\Requests\Brickables\Carousel;

use App\Models\Brickables\CarouselBrickSlide;
use Illuminate\Foundation\Http\FormRequest;

class CarouselSlidesReorganizeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ordered_ids' => ['required', 'array'],
            'ordered_ids.*' => ['required', 'integer', 'exists:' . CarouselBrickSlide::class . ',id'],
        ];
    }
}
