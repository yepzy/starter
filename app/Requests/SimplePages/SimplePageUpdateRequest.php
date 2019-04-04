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
            'slug' => Str::slug($this->slug),
            'url'  => Str::slug($this->url),
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
            'slug'        => ['string', 'max:255', 'alpha_dash', 'unique:simple_pages,slug,' . $this->page->id],
            'url'         => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                'unique:simple_pages,url,' . $this->page->id,
                new UrlUnique,
            ],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
            'active'      => ['required', 'boolean'],
        ];
    }
}
