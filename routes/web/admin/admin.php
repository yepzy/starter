<?php

Route::get(
    LaravelLocalization::transRoute('routes.admin.index'),
    'AdminController@index'
)->name('admin');
