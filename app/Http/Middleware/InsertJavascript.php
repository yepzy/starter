<?php

namespace App\Http\Middleware;

use Closure;
use JavaScript;

class InsertJavascript
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        JavaScript::put([
            'locale'        => app()->getLocale(),
            'notifications' => __('notifications'),
            'cookieConsent' => __('cookieconsent'),
            'sumoSelect'    => __('sumoselect'),
            'static'        => __('static'),
            'routes'        => [
                'page' => [
                    'termsOfService' => ($termsOfService = cache('termsOfService'))
                        ? route('simplePage.show', ['url' => $termsOfService->url])
                        : null,
                ],
            ],
        ]);

        return $next($request);
    }
}
