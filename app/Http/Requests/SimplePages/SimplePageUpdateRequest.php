<?php

namespace App\Http\Requests\SimplePages;

use App\Http\Requests\Request;
use App\Rules\UrlUnique;
use Illuminate\Support\Str;

class SimplePageUpdateRequest extends Request
{
    protected $exceptFromSanitize = [];
    protected $safetyChecks = ['active' => 'boolean'];

    /**
     * Execute a pre-validation treatment.
     *
     * @return void
     */
    public function before()
    {
        $this->merge([
            'url' => Str::slug($this->url),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.c
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url'         => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                'unique:simple_pages,url,' . $this->simplePage->id,
                new UrlUnique,
            ],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
            'active'      => ['required', 'boolean'],
        ];
    }
}
