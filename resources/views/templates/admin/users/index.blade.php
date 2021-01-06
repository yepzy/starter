@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-users fa-fw"></i>
        {{ __('breadcrumbs.orphan.index', ['entity' => __('Users')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        {{ $table }}
    </x-admin.forms.card>
@endsection
