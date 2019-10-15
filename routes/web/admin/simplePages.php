<?php

use App\Http\Controllers\Admin\SimplePagesController;

Route::get(LaravelLocalization::transRoute('routes.simplePages.index'), [
    SimplePagesController::class, 'index'
])->name('simplePages');
Route::get(LaravelLocalization::transRoute('routes.simplePages.create'), [
    SimplePagesController::class, 'create'
])->name('simplePage.create');
Route::post(LaravelLocalization::transRoute('routes.simplePages.store'), [
    SimplePagesController::class, 'store'
])->name('simplePage.store');
Route::get(LaravelLocalization::transRoute('routes.simplePages.edit'), [
    SimplePagesController::class, 'edit'
])->name('simplePage.edit');
Route::put(LaravelLocalization::transRoute('routes.simplePages.update'), [
    SimplePagesController::class, 'update'
])->name('simplePage.update');
Route::delete(LaravelLocalization::transRoute('routes.simplePages.destroy'), [
    SimplePagesController::class, 'destroy'
])->name('simplePage.destroy');
