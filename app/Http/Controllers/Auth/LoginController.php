<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use SEO;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers {
        sendLockoutResponse as protected traitSendLockoutResponse;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        SEO::setTitle(__('auth.title.signIn'));

        return view('templates.auth.login');
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return route('admin');
    }

    /**
     * The user has logged out of the application.
     *
     * @return mixed
     */
    protected function loggedOut()
    {
        alert()->toast(__('notifications.message.logout.success'), 'success', 'top-right');
        return;
    }

    /**
     * Get the failed login response instance.
     *
     * @return void
     */
    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([$this->username() => [trans('notifications.message.login.failed')]])
            ->redirectTo(route('login'));
    }

    /**
     * The user has been authenticated.
     *
     * @return mixed
     */
    protected function authenticated()
    {
        alert()->toast(__('notifications.message.login.success', [
            'name' => auth()->user()->name,
        ]), 'success', 'top-right');
        return;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn($this->throttleKey($request));
        throw ValidationException::withMessages([
            $this->username() => [__('notifications.message.login.throttle', ['seconds' => $seconds])],
        ])->status(429);
    }
}
