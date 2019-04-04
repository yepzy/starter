<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UsersSearchRequest extends Request
{
    protected $safetyChecks = [
        'users'                => 'array',
        'companies'            => 'array',
        'professional_domains' => 'array',
        'connected'            => 'boolean',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'users'                => ['present', 'array'],
            'companies'            => ['present', 'array'],
            'professional_domains' => ['present', 'array'],
            'connected'            => ['required', 'boolean'],
            'nb_elements'          => [
                'numeric',
                'in:' . implode(',', array_pluck(config('filters.nb_elements'), 'label')),
            ],
        ];
    }
}
