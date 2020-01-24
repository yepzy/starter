@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ inputText()->name('title')
        ->locales(supportedLocaleKeys())
        ->prepend(false)->value(fn($locale) => translatedData($brick, 'data.title', $locale))
        ->containerHtmlAttributes(['required']) }}
@endsection
