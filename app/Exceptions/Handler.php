<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Validation\ValidationException;

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
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Convert a validation exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Validation\ValidationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function invalid($request, ValidationException $exception)
    {
        if (! $request->expectsJson()) {
            toast(__('notifications.message.validation.failed'), 'error');
        }

        return parent::invalid($request, $exception);
    }

    /**
     * Render the given HttpException.
     *
     * @param \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpExceptionInterface $exception)
    {
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