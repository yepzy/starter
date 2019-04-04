<?php

Route::get(
    LaravelLocalization::transRoute('routes.registration.index'),
    'RegisterController@showRegistrationForm'
)->name('register')->middleware('guest');
Route::post(
    LaravelLocalization::transRoute('routes.registration.register'),
    'RegisterController@register'
)->name('register.register')->middleware('guest');
