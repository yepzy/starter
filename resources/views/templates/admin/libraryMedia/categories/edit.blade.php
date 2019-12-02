@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            @lang('admin.title.parent.edit', [
                'parent' => __('entities.libraryMedia'),
                'entity' => __('entities.categories'), 'detail' => $category->name,
            ])
        @else
            @lang('admin.title.parent.create', [
                'parent' => __('entities.libraryMedia'),
                'entity' => __('entities.categories'),
            ])
        @endif
    </h1>
    <hr>
    <form action="{{ $category ? route('libraryMedia.category.update', $category) : route('libraryMedia.category.store') }}"
          method="POST">
        @csrf
        @if($category)
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
                <h3>@lang('admin.section.identity')</h3>
                {{ bsText()->name('name')->model($category)->containerHtmlAttributes(['required']) }}
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('libraryMedia.categories.index')->containerClasses(['mr-2']) }}
                    @if($category){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
