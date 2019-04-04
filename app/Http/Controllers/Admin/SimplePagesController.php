<?php

namespace App\Http\Controllers\Admin;

use App\Models\SimplePage;
use App\Services\Utils\SeoService;
use App\Http\Controllers\Controller;
use App\Services\SimplePages\PagesService;
use App\Http\Requests\SimplePages\SimplePageStoreRequest;
use App\Http\Requests\SimplePages\SimplePageUpdateRequest;

class SimplePagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new PagesService)->table();
        (new SeoService)->seoMeta(__('admin.title.orphan.index', ['entity' => __('entities.simplePages')]));

        return view('templates.admin.simple-pages', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $page = null;
        (new SeoService)->seoMeta(__('admin.title.create', ['entity' => __('entities.users')]));

        return view('templates.admin.simple-page-edit', compact('page'));
    }

    /**
     * @param \App\Http\Requests\SimplePages\SimplePageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SimplePageStoreRequest $request)
    {
        $page = (new SimplePage)->create($request->all());

        return redirect()->route('simplePages')->with('toast_success', __('notifications.message.crud.orphan.created', [
            'entity' => __('entities.simplePages'),
            'name'   => $page->title,
        ]));
    }

    /**
     * @param \App\Models\SimplePage $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SimplePage $page)
    {
        (new SeoService)->seoMeta(__('admin.title.orphan.edit', [
            'entity' => __('entities.simplePages'),
            'detail' => $page->title,
        ]));

        return view('templates.admin.simple-page-edit', compact('page'));
    }

    /**
     * @param \App\Models\SimplePage $page
     * @param \App\Http\Requests\SimplePages\SimplePageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SimplePage $page, SimplePageUpdateRequest $request)
    {
        $page->update($request->all());

        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('entities.simplePages'),
            'name'   => $page->title,
        ]));
    }

    /**
     * @param \App\Models\SimplePage $page
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SimplePage $page)
    {
        $name = $page->title;
        $page->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('entities.simplePages'),
            'name'   => $name,
        ]));
    }
}
