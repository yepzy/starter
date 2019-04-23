<?php

namespace App\Http\Controllers\Admin;

use App\Models\SimplePage;
use App\Services\Utils\SeoService;
use App\Http\Controllers\Controller;
use App\Services\SimplePages\PagesService;
use App\Http\Requests\SimplePages\SimplePageStoreRequest;
use App\Http\Requests\SimplePages\SimplePageUpdateRequest;
use Illuminate\Support\Str;

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

        return view('templates.admin.simplePages.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $simplePage = null;
        (new SeoService)->seoMeta(__('admin.title.orphan.create', ['entity' => __('entities.users')]));

        return view('templates.admin.simplePages.edit', compact('simplePage'));
    }

    /**
     * @param \App\Http\Requests\SimplePages\SimplePageStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(SimplePageStoreRequest $request)
    {
        $simplePage = (new SimplePage)->create($request->all());
        cache()->forever(Str::camel($simplePage->slug), $simplePage);

        return redirect()->route('simplePages')->with('toast_success', __('notifications.message.crud.orphan.created', [
            'entity' => __('entities.simplePages'),
            'name'   => $simplePage->title,
        ]));
    }

    /**
     * @param \App\Models\SimplePage $simplePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SimplePage $simplePage)
    {
        (new SeoService)->seoMeta(__('admin.title.orphan.edit', [
            'entity' => __('entities.simplePages'),
            'detail' => $simplePage->title,
        ]));

        return view('templates.admin.simplePages.edit', compact('simplePage'));
    }

    /**
     * @param \App\Models\SimplePage $simplePage
     * @param \App\Http\Requests\SimplePages\SimplePageUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(SimplePage $simplePage, SimplePageUpdateRequest $request)
    {
        cache()->forget(Str::camel($simplePage->slug));
        $simplePage->update($request->all());
        cache()->forever(Str::camel($simplePage->slug), $simplePage);

        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('entities.simplePages'),
            'name'   => $simplePage->title,
        ]));
    }

    /**
     * @param \App\Models\SimplePage $simplePage
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(SimplePage $simplePage)
    {
        $name = $simplePage->title;
        $simplePage->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('entities.simplePages'),
            'name'   => $name,
        ]));
    }
}
