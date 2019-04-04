<?php

namespace App\Services\Slides;

use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Okipa\LaravelTable\Table;

interface SlidesServiceInterface extends ServiceInterface
{
    /**
     * Get the slide route from the parent model and the the given action.
     *
     * @param \Illuminate\Database\Eloquent\Model $parentModel
     * @param string $action
     *
     * @return string
     */
    public function route(Model $parentModel, string $action): string;

    /**
     * Get the parent entity name from the parent model.
     *
     * @param \Illuminate\Database\Eloquent\Model $parentModel
     *
     * @return string
     */
    public function parentEntityName(Model $parentModel): string;

    /**
     * Get the slides table list.
     *
     * @param \Illuminate\Database\Eloquent\Model $relatedModelInstance
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(Model $relatedModelInstance): Table;
}
