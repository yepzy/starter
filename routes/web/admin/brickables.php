<?php

use App\Http\Controllers\Brickables\CarouselBricksController;
use Okipa\LaravelBrickables\Controllers\DispatchController;

Brickables::routes();

// carousel
Route::post(
    Lang::uri('brick/carousel/move/up/{slide}'),
    [DispatchController::class, 'moveUpSlide']
)->name('brick.carousel.slide.move.up');
Route::post(
    Lang::uri('brick/carousel/move/down/{slide}'),
    [DispatchController::class, 'moveDownSlide']
)->name('brick.carousel.slide.move.down');
Route::delete(
    Lang::uri('brick/carousel/slide/destroy/{slide}'),
    [CarouselBricksController::class, 'destroySlide']
)->name('brick.carousel.slide.destroy');
