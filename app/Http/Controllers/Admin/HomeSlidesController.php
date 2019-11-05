<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeSlidesReorganizeRequest;
use App\Http\Requests\Home\HomeSlidesStoreRequest;
use App\Http\Requests\Home\HomeSlidesUpdateRequest;
use App\Models\HomePage;
use App\Models\HomeSlide;
use App\Services\Home\HomeSlidesService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\View\View;
use JavaScript;

class HomeSlidesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        SEOTools::setTitle(__('admin.title.parent.index', [
            'parent' => __('entities.home'),
            'entity' => __('entities.slides'),
        ]));
        $table = (new HomeSlidesService)->table();
        Javascript::put([
            'slides' => [
                'route' => [
                    'reorganize' => route('home.slides.reorganize'),
                ],
            ],
        ]);
        $js = mix('/js/home/slides/index.js');

        return view('templates.admin.home.slides.index', compact('table', 'js'));
    }

    /**
     * @param \App\Models\HomePage $homePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(HomePage $homePage)
    {
        $homeSlide = null;

        return view(
            'templates.admin.home.slides.edit',
            compact('homePage', 'homeSlide')
        );
    }

    /**
     * @param \App\Http\Requests\Home\HomeSlidesStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(HomeSlidesStoreRequest $request)
    {
        /** @var \App\Models\HomePage $homePage */
        $homePage = (new HomePage)->firstOrFail();
        /** @var \App\Models\HomeSlide $slide */
        $slide = (new HomeSlide)->create(array_merge($request->validated(), ['home_page_id' => $homePage->id]));
        if ($request->file('illustration')) {
            $slide->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }

        return redirect()->route('home.slides')
            ->with('toast_success', __('notifications.message.crud.parent.created', [
                'parent' => __('entities.home'),
                'entity' => __('entities.slides'),
                'name'   => $slide->title,
            ]));
    }

    /**
     * @param \App\Models\HomePage $homePage
     * @param \App\Models\HomeSlide $homeSlide
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(HomePage $homePage, HomeSlide $homeSlide)
    {
        SEOTools::setTitle(__('admin.title.parent.edit', [
            'parent' => __('entities.home'),
            'entity' => __('entities.slides'),
            'detail' => $homeSlide->title,
        ]));

        return view(
            'templates.admin.home.slides.edit',
            compact('homePage', 'homeSlide')
        );
    }

    /**
     * @param \App\Models\HomeSlide $homeSlide
     * @param \App\Http\Requests\Home\HomeSlidesUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(HomeSlide $homeSlide, HomeSlidesUpdateRequest $request)
    {
        $homeSlide->update($request->validated());
        if ($request->file('illustration')) {
            $homeSlide->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }

        return back()->with('toast_success', __('notifications.message.crud.parent.updated', [
            'parent' => __('entities.home'),
            'entity' => __('entities.slides'),
            'name'   => $homeSlide->title,
        ]));
    }

    /**
     * @param \App\Models\HomeSlide $homeSlide
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(HomeSlide $homeSlide)
    {
        $homePage = $homeSlide->homePage;
        $name = $homeSlide->title;
        $homeSlide->delete();
        $orderedIds = (new HomeSlide)->where('home_page_id', $homePage->id)->ordered()->pluck('id');
        (new HomeSlide)->setNewOrder($orderedIds);

        return back()->with('toast_success', __('notifications.message.crud.parent.destroyed', [
            'parent' => __('entities.home'),
            'entity' => __('entities.slides'),
            'name'   => $name,
        ]));
    }

    /**
     * @param \App\Http\Requests\Home\HomeSlidesReorganizeRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function reorganize(HomeSlidesReorganizeRequest $request)
    {
        (new HomeSlide)->setNewOrder($request->ordered_ids);

        return response(['message' => __('notifications.message.reorganization.success')], 200);
    }
}
