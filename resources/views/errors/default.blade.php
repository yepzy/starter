@extends('layouts.front.empty')

@section('template')
    <div id="error" class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-3">
                    @if($icon = $settings->media->where('collection_name', 'icon')->first())
                        {{ $icon('auth') }}
                    @endif
                </div>
                <i class="fas fa-fw fa-5x fa-exclamation-triangle  text-danger"></i>
                <h1 class="h3 font-weight-normal mt-3">
                    @lang('errors.title') {{ $exception->getStatusCode() }}
                </h1>
                <p class="h5">
                    @lang('errors.message.' . $exception->getStatusCode())
                </p>
                {{ bsBack()->route('home')->label($exception->getStatusCode() == 503
                    ? __('static.action.retry')
                    : __('static.action.backHome'))->containerClass(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection
