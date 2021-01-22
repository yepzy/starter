@extends('laravel-brickables::admin.form.layout')
@section('title')
    {{ __('Carousel configuration') }}
@endsection
@section('inputs')
    {{ inputSwitch()->name('full_width')->checked((bool) data_get($brick, 'data.full_width')) }}
@endsection
@section('append')
    <x-admin.forms.card title="{{ __('Slides') }}" class="mt-3">
        @if($brick)
            @include('components.admin.table.drag-and-drop')
            <div data-sortable
                 data-sortable-container-selector="#carousel-brick-slides-table tbody"
                 data-sortable-elements-selector="tr"
                 data-sortable-reorder-url="{{ route('brick.carousel.slides.reorder') }}">
                {{ $table }}
            </div>
        @else
            <i class="fas fa-info-circle fa-fw text-info"></i>
            {{ __('Slides management will be available after the brick creation.') }}
        @endif
    </x-admin.forms.card>
@endsection
