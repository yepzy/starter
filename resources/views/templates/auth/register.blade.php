@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
        'containerClass'        => 'text-right',
        'dropdownLabelClass'    => ['btn', 'btn-link'],
        'dropdownMenuClass'     => 'dropdown-menu-right'
    ])
    @if($icon = $settings->media->where('collection_name', 'icon')->first())
        <div class="mx-auto mb-3">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-fw fa-user-plus"></i>
        @lang('auth.title.signUp')
    </h1>
    <form method="POST" class="w-100" action="{{ route('register.register') }}">
        @csrf
        @include('components.common.form.notice')
        {{ bsText()->name('first_name')
            ->icon('<i class="fas fa-user"></i>')
            ->containerHtmlAttributes(['required']) }}
        {{ bsText()->name('last_name')
            ->icon('<i class="fas fa-user"></i>')
            ->containerHtmlAttributes(['required']) }}
        {{ bsEmail()->name('email')
            ->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password')
            ->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password_confirmation')
            ->containerHtmlAttributes(['required']) }}
        {{ bsValidate()->label(__('auth.label.createAccount'))
            ->componentClass(['btn', 'btn-block', 'btn-primary', 'spin-on-click']) }}
    </form>
    {{ bsCancel()->route('login') }}
@endsection
