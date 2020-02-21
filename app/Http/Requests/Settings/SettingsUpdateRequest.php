<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
{
    /** @inheritDoc */
    protected function prepareForValidation()
    {
        $this->merge(['remove_icon' => boolval($this->remove_icon)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Exception
     */
    public function rules()
    {
        return [
            'icon' => settings()->validationConstraints('icons'),
            'remove_icon' => ['required', 'boolean'],
            'email' => ['required', 'string', 'max:255', 'email:rfc,dns,spoof'],
            'phone_number' => ['required', 'string', 'max:255', 'phone:AUTO'],
            'address' => ['string', 'max:255'],
            'zip_code' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'facebook' => ['string', 'max:255', 'url'],
            'instagram' => ['string', 'max:255', 'url'],
            'google_tag_manager_id' => ['string', 'max:255'],
        ];
    }
}
