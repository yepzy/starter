<?php

namespace App\Http\Requests\Contact;

use App\Http\Requests\AbstractSeoRequest;

class ContactPageUpdateRequest extends AbstractSeoRequest
{
    public function rules(): array
    {
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:65535'],
        ]);

        return array_merge($localizedRules, parent::rules());
    }
}
