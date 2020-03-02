<?php

namespace App\Http\Requests;

use App\Models\Pages\PageContent;
use Illuminate\Foundation\Http\FormRequest;

abstract class SeoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'meta_image' => (new PageContent)->validationRules('seo'),
            'remove_meta_image' => ['required', 'boolean'],
        ], localizeRules([
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['string', 'max:255'],
        ]));
    }

    /** @inheritDoc */
    protected function prepareForValidation()
    {
        $this->merge(['remove_meta_image' => boolval($this->remove_meta_image)]);
    }
}
