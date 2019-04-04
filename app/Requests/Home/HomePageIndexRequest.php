<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class HomePageIndexRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAuthorizedTo('home.page.view');
    }
}
