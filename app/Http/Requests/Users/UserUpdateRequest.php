<?php

namespace App\Http\Requests\Users;

use App\Models\Users\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /** @inheritDoc */
    protected function prepareForValidation()
    {
        $this->merge(['remove_avatar' => boolval($this->remove_avatar)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => (new User)->validationConstraints('avatars'),
            'remove_avatar' => ['required', 'boolean'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $this->user->id,
            ],
            'new_password' => ['string', 'min:' . config('security.password.constraint.min'), 'confirmed'],
        ];
    }
}
