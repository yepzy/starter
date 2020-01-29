@extends('layouts.front.full')
@section('template')
    <div class="mt-5 mb-4">
        {{ Brickables::displayBricks($pageContent) }}
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('contact.sendMessage') }}" method="POST">
                    @csrf()
                    <div class="form-row">
                        <div class="col-md-6">
                            {{ inputText()->name('first_name')
                                ->label(false)
                                ->prepend('<i class="fas fa-user"></i>')
                                ->containerHtmlAttributes(['required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ inputText()->name('last_name')
                                ->label(false)
                                ->prepend('<i class="fas fa-user"></i>')
                                ->containerHtmlAttributes(['required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ inputEmail()->name('email')->label(false)->containerHtmlAttributes(['required']) }}
                        </div>
                        <div class="col-md-6">
                            {{ inputTel()->name('phone_number')->label(false) }}
                        </div>
                        <div class="col-md-12">
                            {{ textarea()->name('message')
                                ->label(false)
                                ->componentHtmlAttributes(['rows' => 5])
                                ->containerHtmlAttributes(['required']) }}
                        </div>
                        <div class="col-md-8">
                            @include('components.common.form.notice')
                        </div>
                        <div class="col-md-4 text-right">
                            {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')->label(__('Send')) }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h4 m-0">
                            <i class="far fa-address-book fa-fw"></i>
                            @lang('Contact us')
                        </h2>
                    </div>
                    <div class="card-body">
                        <h3 class="h5 mb-3">
                            {{ config('app.name') }}
                        </h3>
                        @if($phoneNumber = settings()->phone_number)
                            <p class="d-flex align-items-start">
                                <span class="mr-1"><i class="fas fa-phone-alt fa-fw"></i></span>
                                {{ $phoneNumber }}
                            </p>
                        @endif
                        @if($email = settings()->email)
                            <p class="d-flex align-items-start">
                                <span class="mr-1"><i class="fas fa-at fa-fw"></i></span>
                                {{ $email }}
                            </p>
                        @endif
                        @if($fullPostalAddress = settings()->full_postal_address)
                            <p class="d-flex align-items-start">
                                <span class="mr-1"><i class="fas fa-compass fa-fw"></i></span>
                                {{ $fullPostalAddress }}
                            </p>
                        @endif
                    </div>
                    @if($fullPostalAddress = settings()->full_postal_address)
                        <div class="card-footer">
                            <a class="h5"
                               href="//maps.google.com/maps?q={{ str_replace([' ', ','], '+', $fullPostalAddress) }}"
                               data-lity>
                                <i class="fas fa-search-location fa-fw"></i>
                                @lang('Where to find us ?')
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
