<?php

Route::get(
    LaravelLocalization::transRoute('routes.home.page.index'),
    'HomePageController@index'
)->name('home');
