<?php

namespace App\Services\Home;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface HomeSlidesServiceInterface extends ServiceInterface
{
    /**
     * Generate the home slides table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table;
}
