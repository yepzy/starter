<?php

namespace App\Services\Home;

use App\Models\HomePage;
use App\Services\Service;
use Okipa\LaravelTable\Table;
use Spatie\MediaLibrary\Models\Media;

class HomePageService extends Service implements HomePageServiceInterface
{
    /**
     * Configure the shortcuts table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table
    {
        $table = (new Table)->model(Media::class)->routes([
            'index'   => ['name' => 'home.page.edit'],
            'create'  => ['name' => 'home.shortcut.create'],
            'edit'    => ['name' => 'home.shortcut.edit'],
            'destroy' => ['name' => 'home.shortcut.destroy'],
        ])->query(function ($query) {
            $query->select('media.*');
            $query->addSelect('media.custom_properties->>title as title');
            $query->where('model_type', HomePage::class);
            $query->where('collection_name', 'shortcut');
        });
        $table->column()->title(__('validation.attributes.image'))->html(function ($entity) {
            return image()->src($entity->getUrl('thumb'))->linkUrl($entity->getUrl('tile'))->toHtml();
        });
        $table->column('title')->sortable();
        $table->column('link_url')->sortable()->html(function ($entity) {
            return view('components.admin.table.link', [
                'url'    => $entity->getCustomProperty('link_url'),
                'active' => $entity->getCustomProperty('active'),
            ]);
        });
        $table->column('file_name')->stringLimit(30)->sortable()->searchable();
        $table->column('active')->sortable()->html(function ($entity) {
            return view('components.admin.table.active', ['active' => $entity->getCustomProperty('active')]);
        });

        return $table;
    }
}
