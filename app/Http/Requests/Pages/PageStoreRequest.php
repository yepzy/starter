<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\Request;
use App\Services\Seo\SeoService;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Support\Str;

class PageStoreRequest extends Request
{
    protected $exceptFromSanitize = ['url'];

    protected $safetyChecks = ['active' => 'boolean'];

    /**
     * Execute a pre-validation treatment.
     *
     * @return void
     */
    public function before()
    {
        $this->merge(['slug' => Str::slug($this->slug)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'slug' => ['required', 'alpha_dash', 'unique:pages'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = $this->localizeRules([
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('pages'),
            ],
            'nav_title' => ['required', 'string', 'max:255'],
        ]);
        $seoMetaRules = (new SeoService)->getSeoMetaRules();

        return array_merge($rules, $localizedRules, $seoMetaRules);
    }
}
