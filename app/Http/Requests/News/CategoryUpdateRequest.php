<?php

namespace App\Http\Requests\News;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return localizeRules([
            'name' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('news_categories')->ignore($this->category->id),
            ],
        ]);
    }
}
