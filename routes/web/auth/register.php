<?php

use App\Http\Controllers\Auth\RegisterController;

Route::get(LaravelLocalization::transRoute('routes.registration.index'), [
    RegisterController::class,
    'showRegistrationForm',
])->name('register')->middleware('guest');
Route::post(LaravelLocalization::transRoute('routes.registration.register'), [
    RegisterController::class,
    'register',
])->name('register.register')->middleware('guest');
