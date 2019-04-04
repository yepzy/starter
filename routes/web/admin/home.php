<?php

// slides
Route::get(
    LaravelLocalization::transRoute('routes.home.slides.index'),
    'SlidesController@index'
)->name('home.slides');
Route::get(
    LaravelLocalization::transRoute('routes.home.slides.create'),
    'SlidesController@create'
)->name('home.slide.create');
Route::post(
    LaravelLocalization::transRoute('routes.home.slides.store'),
    'SlidesController@store'
)->name('home.slide.store');
Route::get(
    LaravelLocalization::transRoute('routes.home.slides.edit'),
    'SlidesController@edit'
)->name('home.slide.edit');
Route::put(
    LaravelLocalization::transRoute('routes.home.slides.update'),
    'SlidesController@update'
)->name('home.slide.update');
Route::delete(
    LaravelLocalization::transRoute('routes.home.slides.destroy'),
    'SlidesController@destroy'
)->name('home.slide.destroy');
