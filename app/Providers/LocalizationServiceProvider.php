<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use LaravelLocalization;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // time localization
        setlocale(LC_TIME, LaravelLocalization::getCurrentLocaleRegional() . '.UTF-8');
        Carbon::setLocale(config('app.locale'));
    }
}
