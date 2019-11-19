<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;
use App\Models\NewsArticle;
use App\Services\Seo\SeoService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ArticleStoreRequest extends Request
{
    protected $exceptFromSanitize = ['url'];
    protected $safetyChecks = [
        'active'       => 'boolean',
        'category_ids' => 'array',
    ];

    /**
     * Execute a pre-validation treatment.
     *
     * @return void
     */
    public function before()
    {
        $this->merge([
            'url'          => $this->url ? strtolower($this->url) : null,
            'published_at' => $this->published_at ? rescue(function () {
                return Carbon::createFromFormat('d/m/Y H:i', $this->published_at)->toDateTimeString();
            }, 'XXX', false) : null,
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
            'illustration'   => array_merge(['required'], (new NewsArticle)->validationConstraints('illustration')),
            'title'          => ['required', 'string', 'max:255'],
            'url'            => ['required', 'string', 'max:255', 'unique:news_articles,url'],
            'category_ids'   => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', 'exists:news_categories,id'],
            'description'    => ['string', 'max:4294967295'],
            'published_at'   => ['required', 'date_format:Y-m-d H:i:s'],
            'active'         => ['required', 'boolean'],
        ], (new SeoService)->metaTagsRules());
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $customValidator = Validator::make([
            'full_url' => $this->url ? route('news.article.show', $this->url) : null,
        ], [
            'full_url' => ['required', 'string', 'url'],
        ]);
        if ($customValidator->failed()) {
            $validator->after(function ($validator) {
                $validator->errors()->add('url', __('validation.url'));
            });
        }
    }
}
