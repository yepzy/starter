<?php

namespace App\Http\Requests\News;

use App\Http\Requests\SeoRequest;
use App\Models\News\NewsArticle;
use Carbon\Carbon;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class ArticleStoreRequest extends SeoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'illustration' => array_merge(['required'], (new NewsArticle)->validationConstraints('illustration')),
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', 'exists:news_categories,id'],
            'published_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('news_articles'),
            ],
            'description' => ['string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    /** @inheritDoc */
    protected function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->merge([
            'published_at' => $this->published_at ? rescue(
                fn() => Carbon::createFromFormat('d/m/Y H:i', $this->published_at)->toDateTimeString(),
                'XXX',
                false
            ) : null,
            'active' => boolval($this->active),
        ]);
    }
}
