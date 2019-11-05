<?php

namespace App\Services\Seo;

use App\Models\Model;
use App\Services\Service;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class SeoService extends Service implements SeoServiceInterface
{
    /**
     * @return array
     */
    public function exceptMetaTagsFromNullExclusion(): array
    {
        return [
            'meta_title',
            'meta_description',
        ];
    }

    /**
     * @return array
     */
    public function metaTagsRules(): array
    {
        return [
            'meta_title'       => ['string', 'max:255'],
            'meta_description' => ['string', 'max:255'],
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Model $model
     */
    public function saveMetaTagsFromRequest(Request $request, Model $model): void
    {
        $model->removeMeta(['meta_title', 'meta_description']);
        if ($request->has('meta_title')) {
            $model->setMeta('meta_title', $request->meta_title);
        }
        if ($request->has('meta_description')) {
            $model->setMeta('meta_description', $request->meta_description);
        }
    }

    /**
     * @param \App\Models\Model $model
     */
    public function displayMetaTagsFromModel(Model $model): void
    {
        SEOTools::setTitle($model->getMeta('meta_title'));
        SEOTools::setDescription($model->getMeta('meta_description'));
    }
}
