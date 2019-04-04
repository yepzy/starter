<?php

namespace App\Services\SimplePages;

use App\Models\SimplePage;
use App\Services\Service;
use Okipa\LaravelTable\Table;

class PagesService extends Service implements PagesServiceInterface
{
    /**
     * * Configure the simple pages table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table
    {
        $table = (new Table)->model(SimplePage::class)->routes([
            'index'   => ['name' => 'simplePages'],
            'create'  => ['name' => 'simplePage.create'],
            'edit'    => ['name' => 'simplePage.edit'],
            'destroy' => ['name' => 'simplePage.destroy'],
        ])->destroyConfirmationHtmlAttributes(function ($model) {
            return [
                'data-confirm' => __('notifications.message.crud.orphan.destroyConfirm', [
                    'entity' => __('entities.simplePages'),
                    'name'   => $model->title,
                ]),
            ];
        });
        $table->column('title')
            ->sortable(true)
            ->searchable();
        $table->column('slug')
            ->sortable()
            ->searchable();
        $table->column('url')->title(__('components.table.link'))->html(function ($entity) {
            return view('components.admin.table.link', [
                'url'    => route('simplePage.show', ['url' => $entity->url], false),
                'active' => $entity->active,
            ]);
        });
        $table->column('active')
            ->sortable()
            ->html(function ($entity) {
                return view('components.admin.table.active', [
                    'active' => $entity->active,
                ]);
            });

        return $table;
    }
}
