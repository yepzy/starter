@extends('layouts.admin.full')

@section('template')
    <h1>
        <i class="fas fa-fw fa-cog"></i>
        @lang('admin.title.orphan.index', ['entity' => __('entities.settings')])
    </h1>
    <hr>
    <form method="POST" class="w-100" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.identity')</h3>
                {{ bsFile()->name('icon')
                    ->value(optional($settings->media->where('collection_name', 'icon')->first())->file_name)
                    ->uploadedFile(function() use ($settings) {
                        return ($logo = $settings->media->where('collection_name', 'icon')->first())
                            ? image()->src($logo->getUrl('thumb'))
                                ->linkUrl($logo->getUrl('auth'))
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->legend((new \App\Models\Settings)->constraintsLegend('icon')) }}
                <h3 class="pt-4">@lang('admin.section.contact')</h3>
                {{ bsEmail()->name('email')->model($settings)->containerHtmlAttributes(['required']) }}
                {{ bsTel()->name('phone_number')->model($settings)->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('address')->model($settings)->prepend('<i class="fas fa-map-marker"></i>') }}
                {{ bsText()->name('zip_code')->model($settings)->prepend('<i class="fas fa-location-arrow"></i>') }}
                {{ bsText()->name('city')->model($settings)->prepend('<i class="fas fa-thumbtack"></i>') }}
                <h3 class="pt-4">@lang('admin.section.links')</h3>
                {{ bsText()->name('facebook')->model($settings)->prepend('<i class="fab fa-facebook"></i>') }}
                {{ bsText()->name('instagram')->model($settings)->prepend('<i class="fab fa-instagram"></i>') }}
                {{ bsText()->name('google_tag_manager')->model($settings)->prepend('<i class="fas fa-tag"></i>') }}
                <div class="d-flex pt-4">
                    {{ bsUpdate() }}
                </div>

            </div>
        </div>
    </form>
@endsection
