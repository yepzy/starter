<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\CategoryStoreRequest;
use App\Http\Requests\LibraryMedia\CategoryUpdateRequest;
use App\Models\LibraryMediaCategory;
use App\Services\LibraryMedia\CategoriesService;
use Artesaos\SEOTools\Facades\SEOTools;

class LibraryMediaCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new CategoriesService)->table();
        SEOTools::setTitle(__('admin.title.parent.index', [
            'parent' => __('entities.libraryMedia'),
            'entity' => __('entities.categories'),
        ]));

        return view('templates.admin.libraryMedia.categories.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = null;
        SEOTools::setTitle(__('admin.title.parent.create', [
            'parent' => __('entities.libraryMedia'),
            'entity' => __('entities.categories'),
        ]));

        return view('templates.admin.libraryMedia.categories.edit', compact('category'));
    }

    /**
     * @param \App\Http\Requests\LibraryMedia\CategoryStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = (new LibraryMediaCategory)->create($request->validated());

        return redirect()->route('libraryMedia.categories.index')
            ->with('toast_success', __('notifications.message.crud.parent.created', [
                'parent' => __('entities.libraryMedia'),
                'entity' => __('entities.categories'),
                'name'   => $category->name,
            ]));
    }

    /**
     * @param \App\Models\LibraryMediaCategory $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LibraryMediaCategory $category)
    {
        SEOTools::setTitle(__('admin.title.parent.edit', [
            'parent' => __('entities.libraryMedia'),
            'entity' => __('entities.categories'),
            'detail' => $category->name,
        ]));

        return view('templates.admin.libraryMedia.categories.edit', compact('category'));
    }

    /**
     * @param \App\Models\LibraryMediaCategory $category
     * @param \App\Http\Requests\LibraryMedia\CategoryUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LibraryMediaCategory $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('notifications.message.crud.parent.updated', [
            'parent' => __('entities.libraryMedia'),
            'entity' => __('entities.categories'),
            'name'   => $category->name,
        ]));
    }

    /**
     * @param \App\Models\LibraryMediaCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(LibraryMediaCategory $category)
    {
        $name = $category->name;
        $category->delete();

        return back()->with('toast_success', __('notifications.message.crud.parent.destroyed', [
            'parent' => __('entities.libraryMedia'),
            'entity' => __('entities.categories'),
            'name'   => $name,
        ]));
    }
}
