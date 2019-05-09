@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
        'containerClasses'    => 'text-right',
        'dropdownClass'     => 'dropdown-menu-right',
        'labelClass'        => ['btn', 'btn-link']
    ])
    @if($icon = $settings->media->where('collection_name', 'icon')->first())
        <div class="mx-auto mb-3">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-fw fa-sync"></i>
        @lang('auth.title.resetPassword')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.reset') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        @include('components.common.form.notice')
        {{ bsEmail()->name('email')->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password_confirmation')->containerHtmlAttributes(['required']) }}
        {{ bsValidate()->label(__('auth.label.resetPassword'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'spin-on-click']) }}
    </form>
    {{ bsBack()->url(route('login')) }}
@endsection
