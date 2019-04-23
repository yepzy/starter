@extends('layouts.admin.full')

@section('template')
    <h1>
        <i class="fas fa-home fa-fw"></i>
        @if($slide)
            @lang('admin.title.parent.edit', [
                'entity' => __('entities.slides'), 'detail' => $slide->file_name,
                'parent' => (new App\Services\Slides\SlidesRepository)->parentEntityName($parentModel)
            ])
        @else
            @lang('admin.title.parent.create', [
                'entity' => __('entities.slides'),
                'parent' => (new App\Services\Slides\SlidesRepository)->parentEntityName($parentModel)
            ])
        @endif
    </h1>
    <hr>
    <form action="{{ $slide 
        ? route((new App\Services\Slides\SlidesRepository)->route($parentModel, 'update'), $slide)
        : route((new App\Services\Slides\SlidesRepository)->route($parentModel, 'store')) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($slide)
            @method('PUT')
        @endif()
        <input type="hidden" name="parentClass" value="{{ $parentModel->getMorphClass() }}">
        <input type="hidden" name="parentId" value="{{ $parentModel->id }}">
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.media')</h3>
                {{ bsFile()->name('image')
                    ->value(optional($slide)->file_name)
                    ->showRemoveCheckbox(false)
                    ->uploadedFile(function() use($slide) {
                        return $slide 
                            ? image()->src($slide->getUrl('thumb'))->linkUrl($slide->getUrl('cover'))->containerClass(['mb-2']) 
                            : null;
                     })
                    ->containerHtmlAttributes(['required'])
                    ->legend($parentModel->constraintsLegend('slide')) }}
                <h3 class="pt-4">@lang('admin.section.data')</h3>
                {{ bsText()->value(optional($slide)->getCustomProperty('title'))->name('title') }}
                {{ bsTextarea()->name('description')
                    ->hideIcon()
                    ->value(optional($slide)->getCustomProperty('description'))
                    ->componentClass(['editor']) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsToggle()->name('active')->checked($slide ? $slide->getCustomProperty('active') : false) }}
                {{ bsCancel()->route((new App\Services\Slides\SlidesRepository)->route($parentModel, 'index'))
                    ->containerClass(['pt-4', 'mr-3', 'float-left']) }}
                @if($slide)
                    {{ bsUpdate()->containerClass(['pt-4', 'float-left']) }}
                @else
                    {{ bsCreate()->containerClass(['pt-4', 'float-left']) }}
                @endif
            </div>
        </div>
    </form>
@endsection
