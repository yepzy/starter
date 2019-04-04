<?php

if (! function_exists('multilingual')) {
    /**
     * @return bool
     */
    function multilingual(): bool
    {
        return count(LaravelLocalization::getSupportedLocales()) > 1;
    }
}
