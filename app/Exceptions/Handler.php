<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Log;
use Sentry\State\Scope;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /** @inheritDoc */
    public function report(Exception $exception)
    {
        $this->sentryReport($exception);
        parent::report($exception);
    }

    /**
     * Report exception on Sentry.
     *
     * @param \Exception $exception
     */
    public function sentryReport(Exception $exception): void
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            /** @var \App\Models\Users\User|null $user */
            $user = auth()->user();
            if ($user) {
                app('sentry')->configureScope(fn(Scope $scope) => $scope->setUser($user->toArray()));
            }
            app('sentry')->captureException($exception);
        }
    }

    /** @inheritDoc */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /** @inheritDoc */
    protected function invalid($request, ValidationException $exception)
    {
        if (! $request->expectsJson()) {
            toast(__('Invalid fields have been detected.'), 'error');
        }

        return parent::invalid($request, $exception);
    }

    /** @inheritDoc */
    protected function renderHttpException(HttpExceptionInterface $exception)
    {
        Log::error($exception);
        if (! view()->exists("errors.{$exception->getStatusCode()}")) {
            return response()->view(
                'errors.default',
                ['exception' => $exception],
                $exception->getStatusCode(),
                $exception->getHeaders()
            );
        }

        return parent::renderHttpException($exception);
    }
}
