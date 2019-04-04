<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class HomePageUpdateRequest extends Request
{
    protected $safetyChecks = ['speaker_ids' => 'array'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_title'                      => ['required', 'string', 'max:255'],
            'description'                     => ['required', 'string', 'max:65535'],
            'news_title'                      => ['required', 'string', 'max:255'],
            'news_check_all_button_label'     => ['required', 'string', 'max:255'],
            'speakers_title'                  => ['required', 'string', 'max:255'],
            'speakers_check_all_button_label' => ['required', 'string', 'max:255'],
            'speaker_ids'                     => ['present', 'array'],
            'speaker_ids.*'                   => ['numeric', 'exists:users,id'],
        ];
    }
}
