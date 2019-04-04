<?php

Route::get(
    LaravelLocalization::transRoute('routes.login.index'),
    'LoginController@showLoginForm'
)->name('login')->prefix('admin')->middleware('guest');
Route::post(
    LaravelLocalization::transRoute('routes.login.login'),
    'LoginController@login'
)->name('login.login')->middleware('guest');
Route::post(
    LaravelLocalization::transRoute('routes.login.logout'),
    'LoginController@logout'
)->name('logout')->middleware('auth');
Route::get(
    LaravelLocalization::transRoute('routes.login.logout'),
    'LoginController@logout'
)->name('logout')->middleware('auth');
