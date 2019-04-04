@extends('layouts.admin.full')
@php
    switch(request()->route()->getName()){
        case 'user.create' :
            $title = __('admin.title.create', ['entity' => __('entities.users')]);
            $action = route('user.store');
            break;
        case 'user.edit' :
            $title = __('admin.title.orphan.edit', ['entity' => __('entities.users'), 'detail' => $user->name]);
            $action = route('user.update', ['id' => $user->id]);
            break;
        case 'user.profile' :
            $title = __('entities.profile');
            $action = route('user.update', ['id' => $user->id]);
            break;
    }
@endphp
@section('template')
    <h1>
        <i class="fas fa-fw fa-user"></i>
        {{ $title }}
    </h1>
    <hr>
    <form class="mb-3"
          action="{{ $action }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($user)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.identity')</h3>
                {{ bsFile()->name('avatar')
                    ->value(optional(optional($user)->getFirstMedia('avatar'))->file_name)
                    ->uploadedFile(function() use ($user) {
                        $avatar = optional($user)->getFirstMedia('avatar');
                        return $avatar
                            ? image()->src(optional($avatar)->getUrl('thumb'))
                                ->linkUrl(optional($avatar)->getUrl('profile'))
                                ->containerClass(['mb-2'])
                            : null;
                    })
                    ->legend((new App\Models\User)->constraintsLegend('avatar')) }}
                {{ bsText()->name('last_name')->model($user)->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('first_name')->model($user)->containerHtmlAttributes(['required']) }}
                {{-- todo : manage roles --}}
                {{--@if(! in_array(request()->route()->getName(), ['user.profile']))--}}
                    {{--{{ bsSelect()->name('role_id')--}}
                        {{--->options($selectOptions['roleOptions'], 'id', 'name')--}}
                        {{--->selected('id', !$user ? $selectOptions['roleOptions']->where('slug', 'visitor')->first()->id : $user->role_id)--}}
                        {{--->componentClass(['selector'])--}}
                        {{--->containerHtmlAttributes(['required']) }}--}}
                {{--@endif--}}
                <h3 class="pt-4">@lang('admin.section.contact')</h3>
                {{ bsEmail()->name('email')->model($user)->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('admin.section.security')</h3>
                {{ bsPassword()->name($user ? 'new_password' : 'password')
                    ->legend(__('static.legend.password.constraint.min') . ' ' 
                        . __('static.legend.password.constraint.string') 
                        . ' ' . __('static.legend.password.update'))
                    ->containerHtmlAttributes($user ? [] : ['required'])  }}
                {{ bsPassword()->name('password_confirmation')
                    ->model($user)
                    ->containerHtmlAttributes($user ? [] : ['required']) }}
                {{ bsCancel()->url(route('users'))->containerClass(['pt-4', 'mr-3', 'float-left']) }}
                @if($user)
                    {{ bsUpdate()->containerClass(['pt-4', 'float-left']) }}
                @else
                    {{ bsCreate()->containerClass(['pt-4', 'float-left']) }}
                @endif
            </div>
        </div>
    </form>
@endsection
