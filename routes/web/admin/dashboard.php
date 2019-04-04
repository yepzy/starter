<?php

Route::get(
    LaravelLocalization::transRoute('routes.dashboard.index'),
    'DashboardController@index'
)->name('dashboard');
