<?php

namespace App\Http\Controllers\Admin;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageUpdateRequest;
use App\Models\Pages\PageContent;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        /** @var PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'contact-page-content']);
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Contact'),
            'detail' => __('Page'),
        ]));

        return view('templates.admin.contact.page.edit', compact('pageContent'));
    }

    /**
     * @param \App\Http\Requests\Contact\ContactPageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function update(ContactPageUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = (new PageContent)->where('slug', 'contact-page-content')->firstOrFail();
        // todo: transform in a service
        $titleH1Brick = $pageContent->getFirstBrick(TitleH1::class);
        if ($request->title && $request->title !== data_get($titleH1Brick->data, 'title')) {
            $pageContent->addBrick(TitleH1::class, $request->only('title'));
        }
        $oneTextColumnBrick = $pageContent->getFirstBrick(OneTextColumn::class);
        if ($request->description && $request->description !== data_get($oneTextColumnBrick->data, 'text')) {
            $pageContent->addBrick(OneTextColumn::class, $request->only('description'));
        } elseif (! $request->description) {
            $oneTextColumnBrick->delete();
        }
        (new SeoService)->saveSeoTagsFromRequest($pageContent, $request);

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Contact'),
            'name' => __('Page'),
        ]));
    }
}
