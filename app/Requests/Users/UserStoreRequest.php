<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;
use App\Models\User;

class UserStoreRequest extends Request
{
    protected $safetyChecks = [
        'community_features'                        => 'boolean',
        'chats_unread_messages_email_notifications' => 'boolean',
        'expert_category_ids'                       => 'array',
        'skill_ids'                                 => 'array',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Okipa\MediaLibraryExtension\Exceptions\CollectionNotFound
     * @throws \Okipa\MediaLibraryExtension\Exceptions\ConversionsNotFound
     */
    public function rules()
    {
        return [
            'avatar'     => [(new User)->validationConstraints('avatar')],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.min'       => __('notifications.message.password.wrong'),
            'password.confirmed' => __('notifications.message.password.wrong'),
        ];
    }
}
