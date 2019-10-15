<?php

use App\Http\Controllers\Auth\LoginController;

Route::get(LaravelLocalization::transRoute('routes.login.index'), [
    LoginController::class,
    'showLoginForm',
])->name('login')->prefix('admin')->middleware('guest');
Route::post(LaravelLocalization::transRoute('routes.login.login'), [
    LoginController::class,
    'login',
])->name('login.login')->middleware('guest');
Route::post(LaravelLocalization::transRoute('routes.login.logout'), [
    LoginController::class,
    'logout',
])->name('logout')->middleware('auth');
Route::get(LaravelLocalization::transRoute('routes.login.logout'), [
    LoginController::class,
    'logout',
])->name('logout')->middleware('auth');
