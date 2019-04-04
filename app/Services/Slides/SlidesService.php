<?php

namespace App\Services\Slides;

use App\Models\HomePage;
use App\Services\Service;
use Okipa\LaravelTable\Table;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;

class SlidesService extends Service implements SlidesServiceInterface
{
    /**
     * Configure the slides table list.
     *
     * @param \Illuminate\Database\Eloquent\Model $parentModel
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(Model $parentModel): Table
    {
        $table = (new Table)->model(Media::class)->routes([
            'index'   => ['name' => $this->route($parentModel, 'index')],
            'create'  => [
                'name'   => $this->route($parentModel, 'create'),
                'params' => ['parentClass' => $parentModel->getMorphClass(), 'parentId' => $parentModel->id],
            ],
            'edit'    => [
                'name'   => $this->route($parentModel, 'edit'),
                'params' => ['parentClass' => $parentModel->getMorphClass(), 'parentId' => $parentModel->id],
            ],
            'destroy' => [
                'name'   => $this->route($parentModel, 'destroy'),
                'params' => ['parentClass' => $parentModel->getMorphClass(), 'parentId' => $parentModel->id],
            ],
        ])->query(function ($query) use ($parentModel) {
            $query->select('media.*');
            $query->addSelect('media.custom_properties->>title as title');
            $query->addSelect('media.custom_properties->>link_label as link_label');
            $query->addSelect('media.custom_properties->>link_url as link_url');
            $query->where('model_type', $parentModel->getMorphClass());
            $query->where('collection_name', 'slide');
            $query->where('model_id', $parentModel->id);
        })->destroyConfirmationHtmlAttributes(function ($model) use ($parentModel) {
            return [
                'data-confirm' => __('notifications.message.crud.parent.destroyConfirm', [
                    'parent' => $this->parentEntityName($parentModel),
                    'entity' => __('entities.slides'),
                    'name'   => $model->name,
                ]),
            ];
        });
        $table->column()->title(__('validation.attributes.image'))->html(function ($entity) {
            return image()->src($entity->getUrl('thumb'))->linkUrl($entity->getUrl('cover'))->toHtml();
        });
        $table->column('title')->sortable();
        $table->column('file_name')->stringLimit(30)->sortable(true)->searchable();
        $table->column('active')->sortable()->html(function ($entity) {
            return view('components.admin.table.active', ['active' => $entity->getCustomProperty('active')]);
        });

        return $table;
    }

    /**
     * Get the slide route from the parent model and the the given action.
     *
     * @param \Illuminate\Database\Eloquent\Model $parentModel
     * @param string $action
     *
     * @return string
     */
    public function route(Model $parentModel, string $action): string
    {
        $parent = null;
        $slide = null;
        switch ($parentModel->getMorphClass()) {
            case HomePage::class:
                $parent = 'home';
                $slide = $action === 'index' ? '.slides' : '.slide';
                $action = $action !== 'index' ? '.' . $action : '';
                break;
        }

        return $parent . $slide . $action;
    }

    /**
     * Get the parent entity name from the parent model.
     *
     * @param \Illuminate\Database\Eloquent\Model $parentModel
     *
     * @return string
     */
    public function parentEntityName(Model $parentModel): string
    {
        $parentEntityName = null;
        switch ($parentModel->getMorphClass()) {
            case HomePage::class:
                $parentEntityName = __('entities.home');
                break;
        }

        return $parentEntityName;
    }
}
