<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Route;

class UrlUnique implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $routeStack = Route::getRoutes();
        $routesList = [];
        foreach ($routeStack as $route) {
            if (in_array('GET', $route->methods) && $route->uri != '/') {
                $routesList[] = $route->uri;
            }
        }
        $routesList = array_unique($routesList);

        return ! in_array($value, $routesList);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
