@extends('layouts.front.full')
@section('template')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1>{{ $pageContent->getMeta('title') }}</h1>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text">
                {!! (new Parsedown)->text($pageContent->getMeta('description')) !!}
            </div>
        </div>
    </div>
@endsection
