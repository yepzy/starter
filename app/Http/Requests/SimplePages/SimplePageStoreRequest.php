<?php

namespace App\Http\Requests\SimplePages;

use App\Http\Requests\Request;
use App\Rules\UrlUnique;
use App\Services\Seo\SeoService;
use Illuminate\Support\Str;

class SimplePageStoreRequest extends Request
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'slug'        => ['required', 'string', 'alpha_dash', 'max:255', 'unique:simple_pages,slug'],
            'url'         => ['required', 'string', 'alpha_dash', 'max:255', 'unique:simple_pages,url', new UrlUnique],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
            'active'      => ['required', 'boolean'],
        ], (new SeoService)->metaTagsRules());
    }
}
