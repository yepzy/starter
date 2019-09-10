<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Service;
use Okipa\LaravelTable\Table;
use App\Http\Requests\Request;

class UsersService extends Service implements UsersServiceInterface
{
    /**
     * Get the users table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(User::class)->routes([
            'index'   => ['name' => 'users'],
            'create'  => ['name' => 'user.create'],
            'edit'    => ['name' => 'user.edit'],
            'destroy' => ['name' => 'user.destroy'],
        ])->disableRows(function ($model) {
            return $model->id === auth()->id();
        })->destroyConfirmationHtmlAttributes(function ($user) {
            return [
                'data-confirm' => __('notifications.message.crud.orphan.destroyConfirm', [
                    'entity' => __('entities.settings'),
                    'name'   => $user->name,
                ]),
            ];
        });
        $table->column('avatar')
            ->html(function ($entity) {
                $avatar = $entity->getFirstMedia('avatar');

                return $avatar
                    ? image()->src($avatar->getUrl('thumb'))
                        ->linkUrl($avatar->getUrl('profile'))
                        ->toHtml()
                    : null;
            });
        $table->column('first_name')->sortable(true)->searchable();
        $table->column('last_name')->sortable()->searchable();
        $table->column('email')->sortable()->searchable();

        return $table;
    }

    /**
     * Manage avatar from request.
     *
     * @param \App\Http\Requests\Request $request
     * @param \App\Models\User $user
     *
     * @return void
     */
    public function manageAvatarFromRequest(Request $request, User $user): void
    {
        if ($request->file('avatar')) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        } elseif ($request->method() !== 'PUT' || $request->remove_avatar) {
            $this->setDefaultAvatarImage($user);
        }
    }

    /**
     * Set default avatar image for the given user.
     *
     * @param \App\Models\User $user
     */
    public function setDefaultAvatarImage(User $user): void
    {
        $user->addMedia(database_path('seeds/files/users/default-450-450.png'))
            ->preservingOriginal()
            ->toMediaCollection('avatar');
    }
}
