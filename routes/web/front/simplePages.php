<?php

use App\Http\Controllers\Front\SimplePagesController;

Route::get(LaravelLocalization::transRoute('routes.simplePages.show'), [
    SimplePagesController::class,
    'show',
])->name('simplePage.show')->where('url', '.*');
