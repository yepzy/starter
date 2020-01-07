<?php

use App\Models\Settings;
use App\Models\SimplePage;
use Illuminate\Support\Collection;

if (! function_exists('settings')) {
    /**
     * Get and cache settings.
     *
     * @param bool $clearCache
     *
     * @return \App\Models\Settings
     * @throws \Exception
     */
    function settings(bool $clearCache = false): Settings
    {
        if ($clearCache) {
            cache()->forget('settings');
        }

        return cache()->rememberForever('settings', function () {
            return (new Settings)->with(['media'])->firstOrFail();
        });
    }
}

if (! function_exists('simplePages')) {
    /**
     * Get and cache simple pages.
     *
     * @param bool $clearCache
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    function simplePages(bool $clearCache = false): Collection
    {
        if ($clearCache) {
            cache()->forget('simplePages');
        }

        return cache()->rememberForever('simplePages', function () {
            return (new SimplePage)->where('active', true)->get();
        });
    }
}
