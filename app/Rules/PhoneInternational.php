<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PhoneInternational implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $localizedPhoneNumber = Str::startsWith($value, '0')
            ? Str::replaceFirst('0', '+33', $value)
            : $value;

        return ! Validator::make(
            ['phone_number_validation' => $localizedPhoneNumber],
            ['phone_number_validation' => 'phone:AUTO']
        )->fails();
    }

    public function message(): string
    {
        return __('The :attribute field is an invalid number. In case of foreign number, prefix it with an international calling code (e.g. +49 for Germany).');
    }
}
