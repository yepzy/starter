<?php

namespace App\Http\Controllers\Admin;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsPageUpdateRequest;
use App\Models\Pages\PageContent;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsPageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'news-page-content']);
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('News'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.news.page.edit', compact('pageContent'));
    }

    /**
     * @param \App\Http\Requests\News\NewsPageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function update(NewsPageUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = (new PageContent)->where('slug', 'news-page-content')->firstOrFail();
        $pageContent->addBrick(TitleH1::class, $request->only('title'));
        $request->has('description')
            ? $pageContent->addBrick(OneTextColumn::class, $request->only('description'))
            : $pageContent->getFirstBrick(OneTextColumn::class)->delete();
        (new SeoService)->saveSeoTagsFromRequest($pageContent, $request);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Home'),
            'name' => __('Page'),
        ]));
    }
}
