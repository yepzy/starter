<?php

use App\Http\Controllers\Auth\InitializePasswordController;
use Spatie\WelcomeNotification\WelcomesNewUsers;

Route::get(
    Lang::uri('welcome/{user}'),
    [InitializePasswordController::class, 'showWelcomeForm']
)->name('password.welcome')->middleware(WelcomesNewUsers::class);
Route::post(
    Lang::uri('welcome/{user}'),
    [InitializePasswordController::class, 'savePassword']
)->middleware(WelcomesNewUsers::class);
