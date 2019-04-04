<?php

namespace App\Http\Requests\Users;

use App\Authorization\Models\Role;
use App\Http\Requests\Request;

class UserResetCredentialsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user->role_id === (new Role)->where(['slug' => 'admin'])->firstOrFail()->id) {
            $this->user()->isAuthorizedTo('user.entity.resetCredentials.admin');
        }

        return true;
    }
}
