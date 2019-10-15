<?php

use App\Http\Controllers\Auth\VerificationController;

Route::get(LaravelLocalization::transRoute('routes.verification.notice'), [
    VerificationController::class,
    'show',
])->name('verification.notice')->middleware('auth');
Route::get(LaravelLocalization::transRoute('routes.verification.verify'), [
    VerificationController::class,
    'verify',
])->name('verification.verify')->middleware('auth', 'signed', 'throttle:6,1');
Route::post(LaravelLocalization::transRoute('routes.verification.resend'), [
    VerificationController::class,
    'resend',
])->name('verification.resend')->middleware('auth', 'throttle:6,1');
