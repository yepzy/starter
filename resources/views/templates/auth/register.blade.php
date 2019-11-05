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
        <i class="fas fa-user-plus fa-fw"></i>
        @lang('auth.title.signUp')
    </h1>
    <form method="POST" class="w-100" action="{{ route('register.register') }}">
        @csrf
        @include('components.common.form.notice')
        {{ bsText()->name('first_name')
            ->prepend('<i class="fas fa-user"></i>')
            ->containerHtmlAttributes(['required']) }}
        {{ bsText()->name('last_name')
            ->prepend('<i class="fas fa-user"></i>')
            ->containerHtmlAttributes(['required']) }}
        {{ bsEmail()->name('email')
            ->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password')
            ->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password_confirmation')
            ->containerHtmlAttributes(['required']) }}
        {{ bsValidate()->label(__('auth.label.createAccount'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'spin-on-click']) }}
    </form>
    {{ bsCancel()->route('login') }}
@endsection
