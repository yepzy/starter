@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        ->value(fn($locale) => translatedData($brick, 'data.text_left', $locale))
        ->componentClasses(['editor'])
        ->containerHtmlAttributes(['required']) }}
    @php($image = optional($brick)->getFirstMedia('images'))
    {{ inputFile()->name('image_right')
        ->value(optional($image)->file_name)
        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $image]))
        ->showRemoveCheckbox(false)
        ->containerHtmlAttributes(['required'])
        ->caption($brickable->getBrickModel()->getMediaCaption('images')) }}
    {{ inputToggle()->name('invert_order')->checked(data_get($brick, 'data.invert_order')) }}
@endsection
