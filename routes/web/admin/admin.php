<?php

use App\Http\Controllers\Admin\AdminController;

Route::get(LaravelLocalization::transRoute('routes.admin.index'), [
    AdminController::class,
    'index',
])->name('admin');
