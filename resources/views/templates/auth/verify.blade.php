@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
        'containerClasses'        => 'text-right',
        'dropdownLabelClass'    => ['btn', 'btn-link'],
        'dropdownMenuClass'     => 'dropdown-menu-right'
    ])
    @if($icon = $settings->media->where('collection_name', 'icon')->first())
        <div class="mx-auto mb-3">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-fw fa-sign-in-alt"></i>
        @lang('auth.title.verifyEmail')
    </h1>
    <div>
        @lang('auth.label.beforeResendingVerificationLink')
    </div>
    <div>
        @lang('auth.label.didNotReceivedVerificationLink')
    </div>
    <form class="mt-3" method="GET" action="{{ route('verification.resend') }}">
        {{ bsValidate()->label(__('auth.label.newVerificationEmail'))
         ->prepend('<i class="fas fa-fw fa-paper-plane"></i>')}}
    </form>
@endsection
