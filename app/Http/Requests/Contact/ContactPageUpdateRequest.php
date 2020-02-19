<?php

namespace App\Http\Requests\Contact;

use App\Http\Requests\SeoRequest;

class ContactPageUpdateRequest extends SeoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:65535'],
        ]);

        return array_merge($localizedRules, parent::rules());
    }
}
