<?php

namespace App\Http\Requests\Slides;

use App\Http\Requests\Request;

class SlideUpdateRequest extends Request
{
    protected $safetyChecks = ['active' => 'boolean'];
    protected $exceptFromNullExclusion = ['title', 'description'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'         => [(new $this->parentClass)->validationConstraints('slide')],
            'title'         => ['nullable', 'string', 'max:255'],
            'description'   => ['nullable', 'string', 'max:255'],
            'active'        => ['required', 'boolean'],
        ];
    }
}
