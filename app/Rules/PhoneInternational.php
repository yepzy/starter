<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PhoneInternational implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     * @SuppressWarnings("unused")
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $localizedPhoneNumber = Str::replaceFirst('0', '+33', $value);

        return ! Validator::make(
            ['phone_number_validation' => $localizedPhoneNumber],
            ['phone_number_validation' => 'phone:AUTO']
        )->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.phone_international');
    }
}
