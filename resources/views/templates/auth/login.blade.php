@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
        'containerClasses'        => 'text-right',
        'dropdownLabelClass'    => ['btn', 'btn-link'],
        'dropdownMenuClass'     => 'dropdown-menu-right'
    ])
    @if($icon = $settings->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sign-in-alt fa-fw"></i>
        @lang('auth.title.signIn')
    </h1>
    <form method="POST" class="w-100" novalidate action="{{ route('login.login') }}">
        @csrf
        @include('components.common.form.notice')
        {{ bsEmail()->name('email')->componentHtmlAttributes(['autofocus'])->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ bsToggle()->name('remember') }}
        {{ bsValidate()
            ->label(__('auth.label.signIn'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'load-on-click']) }}
        <div class="form-group d-block">
            <a href="{{ route('password.request') }}">
                @lang('auth.label.forgottenPassword')
            </a>
            {{--todo : uncomment if this feature is needed--}}
            {{--<a href="{{ route('register') }}" class="float-right">--}}
            {{--@lang('auth.label.register')--}}
            {{--</a>--}}
        </div>
    </form>
    {{ bsBack()->url(route('home')) }}
@endsection
