<?php

use App\Http\Controllers\Utils\DownloadController;

Route::get(
    'download',
    [DownloadController::class, 'file']
)->name('download.file');
