<?php

use App\Http\Controllers\Front\NewsArticlesController;

Route::get(LaravelLocalization::transRoute('routes.news.articles.index'), [
    NewsArticlesController::class,
    'index',
])->name('news');
Route::get(LaravelLocalization::transRoute('routes.news.articles.show'), [
    NewsArticlesController::class,
    'show',
])->name('news.article.show');
