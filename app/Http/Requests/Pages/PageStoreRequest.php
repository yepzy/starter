<?php

namespace App\Http\Requests\Pages;

use App\Http\Requests\AbstractSeoRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Support\Str;

class PageStoreRequest extends AbstractSeoRequest
{
    public function rules(): array
    {
        $rules = [
            'slug' => ['required', 'alpha_dash', 'unique:pages'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('pages'),
            ],
            'nav_title' => ['required', 'string', 'max:255'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge([
            'slug' => Str::slug($this->slug),
            'active' => $this->boolean($this->active),
        ]);
    }
}
