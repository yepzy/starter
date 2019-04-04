<?php

namespace App\Services\Home;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface HomePageServiceInterface extends ServiceInterface
{
    /**
     * Configure the shortcuts table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table;
}
