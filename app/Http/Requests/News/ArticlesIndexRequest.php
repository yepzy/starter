<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesIndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['category_id' => ['integer', 'exists:news_categories,id']];
    }
}
