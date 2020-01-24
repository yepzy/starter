@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text')
        ->locales(supportedLocaleKeys())
        ->prepend(false)
        ->value(fn($locale) => translatedData($brick, 'data.text', $locale))
        ->componentClasses(['editor'])
        ->containerHtmlAttributes(['required']) }}
@endsection
