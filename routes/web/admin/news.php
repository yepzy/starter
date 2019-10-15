<?php

use App\Http\Controllers\Admin\NewsArticlesController;
use App\Http\Controllers\Admin\NewsCategoriesController;

// categories
Route::get(LaravelLocalization::transRoute('routes.news.categories.index'), [
    NewsCategoriesController::class,
    'index',
])->name('news.categories');
Route::get(LaravelLocalization::transRoute('routes.news.categories.create'), [
    NewsCategoriesController::class,
    'create',
])->name('news.category.create');
Route::post(LaravelLocalization::transRoute('routes.news.categories.store'), [
    NewsCategoriesController::class,
    'store',
])->name('news.category.store');
Route::get(LaravelLocalization::transRoute('routes.news.categories.edit'), [
    NewsCategoriesController::class,
    'edit',
])->name('news.category.edit');
Route::put(LaravelLocalization::transRoute('routes.news.categories.update'), [
    NewsCategoriesController::class,
    'update',
])->name('news.category.update');
Route::delete(LaravelLocalization::transRoute('routes.news.categories.destroy'), [
    NewsCategoriesController::class,
    'destroy',
])->name('news.category.destroy');
// articles
Route::get(LaravelLocalization::transRoute('routes.news.articles.index'), [
    NewsArticlesController::class,
    'index',
])->name('news.articles');
Route::get(LaravelLocalization::transRoute('routes.news.articles.create'), [
    ewsArticlesController::class,
    'create',
])->name('news.article.create');
Route::post(LaravelLocalization::transRoute('routes.news.articles.store'), [
    NewsArticlesController::class,
    'store',
])->name('news.article.store');
Route::get(LaravelLocalization::transRoute('routes.news.articles.edit'), [
    NewsArticlesController::class,
    'edit',
])->name('news.article.edit');
Route::put(LaravelLocalization::transRoute('routes.news.articles.update'), [
    NewsArticlesController::class,
    'update',
])->name('news.article.update');
Route::delete(LaravelLocalization::transRoute('routes.news.articles.destroy'), [
    NewsArticlesController::class,
    'destroy',
])->name('news.article.destroy');
