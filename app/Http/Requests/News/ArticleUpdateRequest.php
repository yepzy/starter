<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;
use App\Models\NewsArticle;
use App\Services\Seo\SeoService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleUpdateRequest extends Request
{
    protected $safetyChecks = [
        'active'       => 'boolean',
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
        return array_merge([
            'illustration'   => (new NewsArticle)->validationConstraints('illustration'),
            'url'            => ['required', 'string', 'max:255', 'unique:news_articles,url,' . $this->article->id],
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['string', 'max:4294967295'],
            'published_at'   => ['required', 'date_format:Y-m-d H:i:s'],
            'active'         => ['required', 'boolean'],
        ], (new SeoService)->metaTagsRules());
    }
}
