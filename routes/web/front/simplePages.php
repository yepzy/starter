<?php

Route::get(
    LaravelLocalization::transRoute('routes.simplePages.show'),
    'SimplePagesController@show'
)->name('simplePage.show');
