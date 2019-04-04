<?php

namespace App\Services\News;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface ArticlesServiceInterface extends ServiceInterface
{
    /**
     * Generate the news categories table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table;
}
