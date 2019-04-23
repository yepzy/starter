<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use App\Services\Users\UsersService;
use App\Services\Utils\SeoService;
use Auth;
use Hash;

class UsersController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->service = (new UsersService);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     */
    public function index()
    {
        (new SeoService)->seoMeta(__('admin.title.orphan.index', ['entity' => __('entities.users')]));
        $table = $this->service->table();

        return view('templates.admin.users.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function create()
    {
        $user = null;
        (new SeoService)->seoMeta(__('admin.title.create', ['entity' => __('entities.users')]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param \App\Http\Requests\Users\UserStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user = (new User)->create($request->all());
        $this->service->manageAvatarFromRequest($request, $user);

        return redirect()->route('users')->with('toast_success', __('notifications.message.crud.orphan.created', [
            'entity' => __('entities.users'),
            'name'   => $user->name,
        ]));
    }

    /**
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(User $user)
    {
        (new SeoService)->seoMeta(__('admin.title.orphan.edit', [
            'entity' => __('entities.users'),
            'detail' => $user->name,
        ]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param \App\Models\User $user
     * @param \App\Http\Requests\Users\UserUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        if ($password = $request->password) {
            $request->merge(['password' => Hash::make($password)]);
        }
        $user->update($request->all());
        $this->service->manageAvatarFromRequest($request, $user);

        return back()->with('toast_success', $user->id === Auth::id()
            ? __('notifications.message.crud.name.updated', ['name' => __('entities.profile')])
            : __('notifications.message.crud.orphan.updated', [
                'entity' => __('entities.users'),
                'name'   => $user->name,
            ]));
    }

    /**
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('entities.users'),
            'name'   => $name,
        ]));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function profile()
    {
        $user = auth()->user();
        (new SeoService)->seoMeta(__('entities.profile'));

        return view('templates.admin.users.edit', compact('user'));
    }
}
