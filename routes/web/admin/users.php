<?php

use App\Http\Controllers\Admin\UsersController;

Route::get(LaravelLocalization::transRoute('routes.users.index'), [
    UsersController::class,
    'index',
])->name('users');
Route::get(LaravelLocalization::transRoute('routes.users.create'), [
    UsersController::class,
    'create',
])->name('user.create');
Route::post(LaravelLocalization::transRoute('routes.users.store'), [
    UsersController::class,
    'store',
])->name('user.store');
Route::get(LaravelLocalization::transRoute('routes.users.edit'), [
    UsersController::class,
    'edit',
])->name('user.edit');
Route::put(LaravelLocalization::transRoute('routes.users.update'), [
    UsersController::class,
    'update',
])->name('user.update');
Route::delete(LaravelLocalization::transRoute('routes.users.destroy'), [
    UsersController::class,
    'destroy',
])->name('user.destroy');
Route::get(LaravelLocalization::transRoute('routes.users.profile.edit'), [
    UsersController::class,
    'profile',
])->name('user.profile.edit')->middleware('password.confirm');
