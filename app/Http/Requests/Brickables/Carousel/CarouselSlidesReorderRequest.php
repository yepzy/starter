<?php

namespace App\Http\Requests\Brickables\Carousel;

use App\Models\Brickables\CarouselBrickSlide;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarouselSlidesReorderRequest extends FormRequest
{
    public function rules(): array
    {
        return ['ordered_ids' => ['required', 'array', Rule::in(CarouselBrickSlide::pluck('id'))]];
    }
}
