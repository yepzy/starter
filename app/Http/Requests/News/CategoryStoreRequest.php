<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;

class CategoryStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:news_categories,name'],
        ];
    }
}
