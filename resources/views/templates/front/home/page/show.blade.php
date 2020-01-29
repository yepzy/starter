@extends('layouts.front.full')
@section('template')
    <div class="mb-5">
        {{ Brickables::displayBricks($pageContent) }}
    </div>
@endsection
