<?php

// categories
Route::get(
    LaravelLocalization::transRoute('routes.news.categories.index'),
    'NewsCategoriesController@index'
)->name('news.categories');
Route::get(
    LaravelLocalization::transRoute('routes.news.categories.create'),
    'NewsCategoriesController@create'
)->name('news.category.create');
Route::post(
    LaravelLocalization::transRoute('routes.news.categories.store'),
    'NewsCategoriesController@store'
)->name('news.category.store');
Route::get(
    LaravelLocalization::transRoute('routes.news.categories.edit'),
    'NewsCategoriesController@edit'
)->name('news.category.edit');
Route::put(
    LaravelLocalization::transRoute('routes.news.categories.update'),
    'NewsCategoriesController@update'
)->name('news.category.update');
Route::delete(
    LaravelLocalization::transRoute('routes.news.categories.destroy'),
    'NewsCategoriesController@destroy'
)->name('news.category.destroy');
// articles
Route::get(
    LaravelLocalization::transRoute('routes.news.articles.index'),
    'NewsArticlesController@index'
)->name('news.articles');
Route::get(
    LaravelLocalization::transRoute('routes.news.articles.create'),
    'NewsArticlesController@create'
)->name('news.article.create');
Route::post(
    LaravelLocalization::transRoute('routes.news.articles.store'),
    'NewsArticlesController@store'
)->name('news.article.store');
Route::get(
    LaravelLocalization::transRoute('routes.news.articles.edit'),
    'NewsArticlesController@edit'
)->name('news.article.edit');
Route::put(
    LaravelLocalization::transRoute('routes.news.articles.update'),
    'NewsArticlesController@update'
)->name('news.article.update');
Route::delete(
    LaravelLocalization::transRoute('routes.news.articles.destroy'),
    'NewsArticlesController@destroy'
)->name('news.article.destroy');