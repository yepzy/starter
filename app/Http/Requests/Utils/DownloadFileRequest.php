<?php

namespace App\Http\Requests\Utils;

use Illuminate\Foundation\Http\FormRequest;

class DownloadFileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['path' => ['required', 'string'], 'name' => ['string']];
    }
}
