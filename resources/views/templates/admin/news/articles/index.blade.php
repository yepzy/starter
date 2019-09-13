@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-fw fa-pen"></i>
        @lang('admin.title.parent.index', [
            'parent' => __('entities.news'),
            'entity' => __('entities.articles'),
        ])
    </h1>
    <hr>
    <div class="card">
        <div class="card-header">
            <h2 class="m-0">
                @lang('admin.section.list')
            </h2>
        </div>
        <div class="card-body">
            {{ $table }}
        </div>
    </div>
@endsection
