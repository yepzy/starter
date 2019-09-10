<?php

Route::get(
    LaravelLocalization::transRoute('routes.verification.notice'),
    'VerificationController@show'
)->name('verification.notice')->middleware('auth');
Route::get(
    LaravelLocalization::transRoute('routes.verification.verify'),
    'VerificationController@verify'
)->name('verification.verify')->middleware('auth', 'signed', 'throttle:6,1');
Route::post(
    LaravelLocalization::transRoute('routes.verification.resend'),
    'VerificationController@resend'
)->name('verification.resend')->middleware('auth', 'throttle:6,1');
