<?php

namespace App\Http\Requests\News;

use App\Models\News\NewsArticle;
use Illuminate\Foundation\Http\FormRequest;

class ArticlesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['integer', 'exists:' . NewsArticle::class . ',id']];
    }
}
