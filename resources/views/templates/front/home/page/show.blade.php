@extends('layouts.front.full')
@section('template')
    <div id="home">
        @include('components.front.carousel-title-caption', [
            'slides' => $homePage->slides()->where('active', true)->ordered()->get()
        ])
        <div class="container my-5">
            <div class="row">
                <div class="col-12 mb-3">
                    <h1>{{ $homePage->title }}</h1>
                </div>
                <div class="col-12 text">
                    {!! (new Parsedown)->text($homePage->description) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
