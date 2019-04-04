<?php

namespace App\Http\Requests\Slides;

use App\Http\Requests\Request;

class SlideStoreRequest extends Request
{
    protected $safetyChecks = ['active' => 'boolean'];
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'         => ['required', (new $this->parentClass)->validationConstraints('slide')],
            'title'         => ['string', 'max:255'],
            'description'   => ['string', 'max:255'],
            'active'        => ['required', 'boolean'],
        ];
    }
}
