@extends('layouts.admin.full')

@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            @lang('admin.title.parent.edit', [
                'entity' => __('entities.categories'), 'detail' => $category->title,
                'parent' => __('entities.news')
            ])
        @else
            @lang('admin.title.parent.create', [
                'entity' => __('entities.categories'),
                'parent' => __('entities.news')
            ])
        @endif
    </h1>
    <hr>
    <form action="{{ $category ? route('news.category.update', ['id' => $category->id]) : route('news.category.store') }}" method="POST">
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
                {{ bsText()->name('title')->model($category)->containerHtmlAttributes(['required']) }}
                {{ bsCancel()->route('news.categories')->containerClass(['pt-4', 'mr-3', 'float-left']) }}
                @if($category)
                    {{ bsUpdate()->containerClass(['pt-4', 'float-left']) }}
                @else
                    {{ bsCreate()->containerClass(['pt-4', 'float-left']) }}
                @endif
            </div>
        </div>
    </form>
@endsection
