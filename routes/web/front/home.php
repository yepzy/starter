<?php

Route::get(
    LaravelLocalization::transRoute('routes.home.page.index'),
    'HomePageController@show'
)->name('home');
