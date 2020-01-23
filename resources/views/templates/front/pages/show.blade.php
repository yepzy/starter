@extends('layouts.front.full')
@section('template')
    <div class="my-5">
        {{ Brickables::bricks($page) }}
    </div>
@endsection
