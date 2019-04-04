<?php

Route::get(
    LaravelLocalization::transRoute('routes.news.articles.index'),
    'NewsArticlesController@index'
)->name('news');
Route::get(
    LaravelLocalization::transRoute('routes.news.articles.show'),
    'NewsArticlesController@show'
)->name('news.article.show');
