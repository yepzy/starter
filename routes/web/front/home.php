<?php

use App\Http\Controllers\Front\HomePageController;

Route::get(LaravelLocalization::transRoute('routes.home.page.index'), [
    HomePageController::class,
    'show',
])->name('home');
