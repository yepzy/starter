<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\Utils\SeoService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use SEO;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */
    use VerifiesEmails {
        resend as traitResend;
        verify as traitVerify;
    }
    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Show the email verification notice.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        SEO::setTitle(__('auth.title.verifyEmail'));

        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('templates.auth.verify');
    }

    /**
     * @return string
     */
    public function redirectTo()
    {
        return route('home');
    }

    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if (! $request->user()->hasVerifiedEmail()) {
            alert()->html(
                __('notifications.title.success'),
                __('notifications.message.auth.verificationEmailSent', ['email' => $request->user()->email]),
                'success'
            )->showConfirmButton();
        }

        return $this->traitResend($request);
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        alert()->html(
            __('notifications.title.success'),
            __('notifications.message.auth.emailVerified', ['email' => $request->user()->email]),
            'success'
        )->showConfirmButton();

        return $this->traitVerify($request);
    }
}
