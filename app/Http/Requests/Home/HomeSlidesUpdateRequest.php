<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;
use App\Models\HomeSlide;

class HomeSlidesUpdateRequest extends Request
{
    protected $safetyChecks = [
        'active' => 'boolean',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'illustration' => (new HomeSlide)->validationConstraints('illustrations'),
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['string', 'max:65535'],
            'position'     => ['integer'],
            'active'       => ['required', 'boolean'],
        ];
    }
}
