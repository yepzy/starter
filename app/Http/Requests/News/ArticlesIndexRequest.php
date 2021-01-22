<?php

namespace App\Http\Requests\News;

use App\Models\News\NewsArticle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticlesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['integer', Rule::exists(NewsArticle::class, 'id')]];
    }
}
