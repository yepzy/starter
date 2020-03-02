<?php

namespace App\Http\Requests\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => ['required', 'integer', 'exists:library_media_categories,id'],
            'media' => (new LibraryMediaFile)->validationRules('medias'),
            'downloadable' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules(['name' => ['required', 'string', 'max:255']]);

        return array_merge($rules, $localizedRules);
    }

    /** @inheritDoc */
    protected function prepareForValidation()
    {
        $this->merge(['downloadable' => boolval($this->downloadable)]);
    }
}
