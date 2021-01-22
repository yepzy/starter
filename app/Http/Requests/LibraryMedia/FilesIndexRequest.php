<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilesIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return ['category_id' => ['integer', Rule::exists(LibraryMediaCategory::class, 'id')]];
    }
}
