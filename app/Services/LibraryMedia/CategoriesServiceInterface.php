<?php

namespace App\Services\LibraryMedia;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface CategoriesServiceInterface extends ServiceInterface
{
    /**
     * Generate the news categories table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table;
}
