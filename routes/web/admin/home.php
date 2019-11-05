<?php

use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\HomeSlidesController;

// page
Route::get(LaravelLocalization::transRoute('routes.home.page.edit'), [
    HomePageController::class,
    'edit',
])->name('home.page.edit');
Route::put(LaravelLocalization::transRoute('routes.home.page.update'), [
    HomePageController::class,
    'update',
])->name('home.page.update');
// slides
Route::get(LaravelLocalization::transRoute('routes.home.slides.index'), [
    HomeSlidesController::class,
    'index',
])->name('home.slides');
Route::get(LaravelLocalization::transRoute('routes.home.slides.create'), [
    HomeSlidesController::class,
    'create',
])->name('home.slide.create');
Route::post(LaravelLocalization::transRoute('routes.home.slides.store'), [
    HomeSlidesController::class,
    'store',
])->name('home.slide.store');
Route::get(LaravelLocalization::transRoute('routes.home.slides.edit'), [
    HomeSlidesController::class,
    'edit',
])->name('home.slide.edit');
Route::put(LaravelLocalization::transRoute('routes.home.slides.update'), [
    HomeSlidesController::class,
    'update',
])->name('home.slide.update');
Route::delete(LaravelLocalization::transRoute('routes.home.slides.destroy'), [
    HomeSlidesController::class,
    'destroy',
])->name('home.slide.destroy');
Route::post(LaravelLocalization::transRoute('routes.home.slides.reorganize'), [
    HomeSlidesController::class,
    'reorganize'
])->name('home.slides.reorganize');
