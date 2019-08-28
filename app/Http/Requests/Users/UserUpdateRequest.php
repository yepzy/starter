<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;
use App\Models\User;

class UserUpdateRequest extends Request
{
    protected $exceptFromSanitize = ['new_password'];
    protected $safetyChecks = [
        'remove_avatar' => 'boolean',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Spatie\MediaLibrary\Exceptions\CollectionNotFound
     * @throws \Spatie\MediaLibrary\Exceptions\ConversionsNotFound
     */
    public function rules()
    {
        return [
            'avatar'        => (new User)->validationConstraints('avatar'),
            'remove_avatar' => ['required', 'boolean'],
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $this->user->id,
            ],
            'new_password'  => ['string', 'min:6', 'confirmed'],
        ];
    }
}
