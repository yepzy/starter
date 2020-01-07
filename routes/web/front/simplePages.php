<?php

use App\Http\Controllers\Front\SimplePagesController;

Route::get(
    Lang::uri('page/{simplePage}'),
    [SimplePagesController::class, 'show']
)->name('simplePage.show')->where('url', '.*');
