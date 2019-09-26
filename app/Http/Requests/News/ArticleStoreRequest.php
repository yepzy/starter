<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;
use App\Models\NewsArticle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticleStoreRequest extends Request
{
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
            'url'          => Str::slug($this->url),
            'published_at' => $this->published_at
                ? Carbon::createFromFormat('d/m/Y H:i', $this->published_at)->toDateTimeString()
                : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'illustration'   => array_merge(['required'], (new NewsArticle)->validationConstraints('illustration')),
            'title'          => ['required', 'string', 'max:255'],
            'url'            => ['required', 'string', 'alpha_dash', 'max:255', 'unique:news_articles,url'],
            'category_ids'   => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', 'exists:news_categories,id'],
            'description'    => ['string', 'max:4294967295'],
            'published_at'   => ['required', 'date_format:Y-m-d H:i:s'],
            'active'         => ['required', 'boolean'],
        ];
    }
}
