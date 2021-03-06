<?php

namespace App\Http\Requests\News;

use App\Models\News\NewsCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class NewsCategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return localizeRules([
            'name' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for(app(NewsCategory::class)->getTable())->ignore($this->newsCategory),
            ],
        ]);
    }
}
