@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-paper-plane fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('News'), 'entity' => __('Articles')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        {{ $table }}
    </x-admin.forms.card>
@endsection
