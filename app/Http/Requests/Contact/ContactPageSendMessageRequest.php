<?php

namespace App\Http\Requests\Contact;

use App\Rules\PhoneInternational;
use Illuminate\Foundation\Http\FormRequest;

class ContactPageSendMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email:rfc,dns,spoof'],
            'phone_number' => ['nullable', 'string', 'max:255', new PhoneInternational()],
            'message' => ['required', 'string'],
        ];
    }
}
