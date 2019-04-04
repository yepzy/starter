<?php

Route::get(
    LaravelLocalization::transRoute('routes.password.index'),
    'ForgotPasswordController@showLinkRequestForm'
)->name('password.request')->middleware('guest');
Route::post(
    LaravelLocalization::transRoute('routes.password.email'),
    'ForgotPasswordController@sendResetLinkEmail'
)->name('password.email')->middleware('guest');
Route::get(
    LaravelLocalization::transRoute('routes.password.update'),
    'ResetPasswordController@showResetForm'
)->name('password.update')->middleware('guest');
Route::post(
    LaravelLocalization::transRoute('routes.password.reset'),
    'ResetPasswordController@reset'
)->name('password.reset')->middleware('guest');
