<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\SeoRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageUpdateRequest extends SeoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['active' => ['required', 'boolean']];
        $localizedRules = localizeRules([
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('pages')->ignore($this->page->id),
            ],
            'nav_title' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    /** @inheritDoc */
    protected function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->merge(['active' => boolval($this->active)]);
    }
}
