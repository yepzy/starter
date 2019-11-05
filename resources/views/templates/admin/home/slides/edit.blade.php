@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-images fa-fw"></i>
        @if($homeSlide)
            @lang('admin.title.parent.edit', ['parent' => __('entities.home'), 'entity' => __('entities.slides'), 'detail' => $homeSlide->title])
        @else
            @lang('admin.title.parent.create', ['parent' => __('entities.home'), 'entity' => __('entities.slides')])
        @endif
    </h1>
    <hr>
    <form action="{{ $homeSlide ? route('home.slide.update', $homeSlide) : route('home.slide.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($homeSlide)
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
                <h3>@lang('admin.section.media')</h3>
                @php($illustration = optional($homeSlide)->getFirstMedia('illustrations'))
                {{ bsFile()->name('illustration')
                    ->value(optional($illustration)->file_name)
                    ->showRemoveCheckbox(false)
                    ->uploadedFile(function() use ($illustration) {
                        return $illustration
                            ? image()->src($illustration->getUrl('thumb'))
                                ->linkUrl($illustration->getUrl())
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->legend((new \App\Models\HomeSlide)->constraintsLegend('illustrations')) }}
                <h3 class="pt-4">@lang('admin.section.content')</h3>
                {{ bsText()->name('title')->model($homeSlide)->containerHtmlAttributes(['required']) }}
                {{ bsTextarea()->name('description')->model($homeSlide) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsToggle()->name('active')->model($homeSlide) }}
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('home.slides')->containerClasses(['mr-2']) }}
                    @if($homeSlide){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
