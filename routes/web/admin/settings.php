<?php

Route::get(
    LaravelLocalization::transRoute('routes.settings.index'),
    'SettingsController@index'
)->name('settings');
Route::put(
    LaravelLocalization::transRoute('routes.settings.update'),
    'SettingsController@update'
)->name('settings.update');
