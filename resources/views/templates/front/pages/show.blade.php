@extends('layouts.front.full')
@section('template')
    <div class="my-5">
        {{ Brickables::displayBricks($page) }}
    </div>
@endsection
