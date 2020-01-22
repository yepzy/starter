@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use($brick) {
        return translate(data_get($brick, 'data.text_left'), $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
    @php($image = optional($brick)->getFirstMedia('bricks'))
    {{ inputFile()->name('right_image')
        ->value(optional($image)->file_name)
        ->uploadedFile(function() use ($image) {
            return $image
                ? image()->src($image->getUrl('thumb'))->linkUrl($image->getUrl())->linkTitle($image->name)
                : null;
        })
        ->showRemoveCheckbox(false)
        ->containerHtmlAttributes(['required'])
        ->caption($brickable->getBrickModel()->constraintsLegend('bricks')) }}
    {{ inputToggle()->name('invert_order')->checked((bool) data_get($brick, 'invert_order')) }}
@endsection
