<?php

namespace App\Services\News;

use App\Models\NewsArticle;
use App\Services\Service;
use Okipa\LaravelTable\Table;

class ArticlesService extends Service implements ArticlesServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table
    {
        $table = (new Table)->model(NewsArticle::class)->routes([
            'index'   => ['name' => 'news.articles'],
            'create'  => ['name' => 'news.article.create'],
            'edit'    => ['name' => 'news.article.edit'],
            'destroy' => ['name' => 'news.article.destroy'],
        ])->destroyConfirmationHtmlAttributes(function ($model) {
            return [
                'data-confirm' => __('notifications.message.crud.parent.destroyConfirm', [
                    'parent' => __('entities.news'),
                    'entity' => __('entities.articles'),
                    'name'   => $model->title,
                ]),
            ];
        });
        $table->column('illustration')->html(function ($entity) {
            return ($avatar = $entity->media->where('collection_name', 'illustration')->first())
                ? image()->src($avatar->getUrl('thumb'))
                    ->linkUrl($avatar->getUrl('cover'))
                    ->toHtml()
                : null;
        });
        $table->column('title')->stringLimit(50)->sortable()->searchable();
        $table->column()->title(__('validation.attributes.category_ids'))->html(function ($article) {
            return $article->categories->pluck('title')->map(function ($title) {
                return $title
                    ? '<button class="btn btn-sm btn-outline-primary m-1 no-click">' . $title . '</button>'
                    : null;
            })->implode(' ');
        });
        $table->column()->title(__('components.table.link'))->html(function ($entity) {
            return view('components.admin.table.link', [
                'url'    => route('news.article.show', ['url' => $entity->url], false),
                'active' => $entity->active,
            ]);
        });
        $table->column('active')->sortable()->html(function ($entity) {
            return view('components.admin.table.active', [
                'active' => $entity->active,
            ]);
        });
        $table->column('published_at')->dateTimeFormat('d/m/Y H:i')->sortable(true);

        return $table;
    }
}
