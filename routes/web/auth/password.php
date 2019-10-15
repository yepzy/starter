<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get(LaravelLocalization::transRoute('routes.password.index'), [
    ForgotPasswordController::class,
    'showLinkRequestForm',
])->name('password.request');
Route::post(LaravelLocalization::transRoute('routes.password.email'), [
    ForgotPasswordController::class,
    'sendResetLinkEmail',
])->name('password.email');
Route::get(LaravelLocalization::transRoute('routes.password.update'), [
    ResetPasswordController::class,
    'showResetForm',
])->name('password.update');
Route::post(LaravelLocalization::transRoute('routes.password.reset'), [
    ResetPasswordController::class,
    'reset',
])->name('password.reset');
Route::get(LaravelLocalization::transRoute('routes.password.confirm'), [
    ConfirmPasswordController::class,
    'showConfirmForm',
])->name('password.confirm')->middleware('auth');
Route::post(LaravelLocalization::transRoute('routes.password.reconfirm'), [
    ConfirmPasswordController::class,
    'confirm',
])->name('password.reconfirm')->middleware('auth');
