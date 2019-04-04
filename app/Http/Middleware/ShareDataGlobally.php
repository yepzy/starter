<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use App\Models\SimplePage;
use Closure;

class ShareDataGlobally
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
        $sharedData = [
            'settings'       => cache()->rememberForever('settings', function () {
                return (new Settings)->with(['media'])->first();
            }),
            'termsOfService' => cache()->rememberForever('termsOfService', function () {
                return (new SimplePage)->where('slug', 'terms-of-service')->first();
            }),
            'rgpd' => cache()->rememberForever('rgpd', function () {
                return (new SimplePage)->where('slug', 'rgpd')->first();
            }),
        ];
        foreach ($sharedData as $key => $value) {
            view()->share($key, $value);
        }

        return $next($request);
    }
}
