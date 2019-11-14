<?php

namespace App\Services\Seo;

use App\Services\Service;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SeoService extends Service implements SeoServiceInterface
{
    /**
     * @return array
     */
    public function metaTagsRules(): array
    {
        return [
            'meta_title'       => ['required', 'string', 'max:255'],
            'meta_description' => ['string', 'max:255'],
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function saveMetaTagsFromRequest(Request $request, Model $model): void
    {
        if (method_exists($model, 'removeMeta')) {
            $model->removeMeta(['meta_title', 'meta_description']);
        }
        if (method_exists($model, 'setMeta') && $request->has('meta_title')) {
            $model->setMeta('meta_title', $request->meta_title);
        }
        if (method_exists($model, 'setMeta') && $request->has('meta_description')) {
            $model->setMeta('meta_description', $request->meta_description);
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function displayMetaTagsFromModel(Model $model): void
    {
        if (method_exists($model, 'getMeta')) {
            SEOTools::setTitle($model->getMeta('meta_title'));
            SEOTools::setDescription($model->getMeta('meta_description'));
        }
    }
}
