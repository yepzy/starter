<?php

use App\Http\Controllers\Admin\DashboardController;

Route::get(LaravelLocalization::transRoute('routes.dashboard.index'), [
    DashboardController::class,
    'index',
])->name('dashboard');
