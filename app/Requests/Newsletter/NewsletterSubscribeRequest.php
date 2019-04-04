<?php

namespace App\Http\Requests\Newsletter;

use App\Http\Requests\Request;

class NewsletterSubscribeRequest extends Request
{
    protected $safetyChecks = [
        'terms_of_use_acceptation' => 'boolean',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'                    => ['required', 'email'],
            'terms_of_use_acceptation' => ['required', 'accepted'],
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        $redirect = url()->previous() . '#newsletter-subscription';

        return $redirect;
    }
}
