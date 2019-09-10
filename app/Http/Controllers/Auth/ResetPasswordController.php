<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\Utils\SeoService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use SEO;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords {
        reset as traitReset;
        sendResetResponse as traitSendResetResponse;
    }

    /**
     * Display the password reset view for the given token.
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        SEO::setTitle(__('auth.title.resetPassword'));

        return view('templates.auth.password.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetResponse(Request $request, $response)
    {
        $response = 'notifications.message.' . $response;
        alert()->html(__('notifications.title.success'), __($response), 'success')->showConfirmButton();

        return $this->traitSendResetResponse($request, $response);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('admin');
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, string $response)
    {
        alert()->html(__('notifications.title.error'), __('notifications.message.' . $response), 'error')
            ->showConfirmButton();

        return back()->withInput($request->only('email'));
    }
}
