@extends('layouts.admin.full')

@section('template')
    <h1>
        <i class="fas fa-home fa-fw"></i>
        @lang('admin.title.parent.index', [
            'entity' => __('entities.slides'),
            'parent' => (new \App\Services\Slides\SlidesRepository)->parentEntityName($parentModel)
        ])
    </h1>
    <hr>
    <div class="card mb-3">
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
