@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use ($brick) {
        return translate(data_get($brick, 'data.text_left'), $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
    {{ textarea()->name('text_right')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use ($brick) {
        return translate(data_get($brick, 'data.text_right'), $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
@endsection
