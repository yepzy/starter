<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class HomeSlidesReorganizeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ordered_ids'   => ['required', 'array'],
            'ordered_ids.*' => ['required', 'integer', 'exists:home_slides,id'],
        ];
    }
}
