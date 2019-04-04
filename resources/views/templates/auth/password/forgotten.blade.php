@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
        'containerClass'    => 'text-right',
        'dropdownClass'     => 'dropdown-menu-right',
        'labelClass'        => ['btn', 'btn-link']
    ])
    @if($icon = $settings->media->where('collection_name', 'icon')->first())
        <div class="mx-auto mb-3">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-fw fa-unlock-alt"></i>
        @lang('auth.title.forgottenPassword')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.email') }}">
        @csrf
        @include('components.common.form.notice')
        {{ bsEmail()->name('email')
            ->legend(__('static.legend.password.forgotten'))
            ->containerHtmlAttributes(['required']) }}
        {{ bsValidate()->label(__('auth.label.sendEmail'))
            ->componentClass(['btn', 'btn-block', 'btn-primary', 'spin-on-click']) }}
    </form>
    {{ bsCancel()->route('login') }}
@endsection
