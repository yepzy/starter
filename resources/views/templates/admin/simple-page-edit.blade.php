@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-fw fa-file-alt"></i>
        @if($page)
            @lang('admin.title.orphan.edit', ['entity' => __('entities.simplePages'), 'detail' => $page->title])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('entities.simplePages')])
        @endif
    </h1>
    <hr>
    <form action="{{ $page ? route('simplePage.update', ['id' => $page->id]) : route('simplePage.store') }}"
          method="POST">
        @csrf
        @if($page)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        {{-- Title --}}
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.page')</h3>
                {{ bsText()->name('title')->model($page)->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('url')
                    ->model($page)
                    ->icon(route('simplePage.show', ['']) . '/')
                    ->componentClass(['slugify'])
                    ->componentHtmlAttributes(['data-target' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('slug')
                    ->model($page)
                    ->icon('<i class="fas fa-fw fa-key"></i>')
                    ->legend(__('static.legend.slug'))
                    ->componentClass(['slugify'])
                    ->componentHtmlAttributes(['data-target' => '#text-title'])
                    ->containerHtmlAttributes(['required'])}}
                {{ bsTextarea()->name('description')->model($page)->hideIcon()->componentClass(['editor']) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsToggle()->name('active')->model($page) }}
                {{ bsCancel()->route('simplePages')->containerClass(['pt-4', 'mr-3', 'float-left']) }}
                @if($page)
                    {{ bsUpdate()->containerClass(['pt-4', 'float-left']) }}
                @else
                    {{ bsCreate()->containerClass(['pt-4', 'float-left']) }}
                @endif
            </div>
        </div>
    </form>
@endsection
