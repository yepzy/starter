@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    @php($slide = optional($brick)->getFirstMedia('bricks'))
    {{ inputFile()->name('slide')
        ->containerHtmlAttributes(['required'])
        ->caption($brickable->getBrickModel()->constraintsLegend('bricks')) }}
    {{ inputText()->name('label') }}
    {{ inputText()->name('caption')->prepend('<i class="fas fa-align-left"></i>') }}
@endsection

