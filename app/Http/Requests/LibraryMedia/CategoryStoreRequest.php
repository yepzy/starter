<?php

namespace App\Http\Requests\LibraryMedia;

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
            'name' => ['required', 'string', 'max:255', 'unique:library_media_categories,name'],
        ];
    }
}
