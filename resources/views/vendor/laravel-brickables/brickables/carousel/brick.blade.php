@php
    $slides = $brick->getMedia('slides');
@endphp
<div id="label-caption-carousel" class="carousel slide bg-dark" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $key => $slide)
            <div class="carousel-item{{ $loop->first ? ' active' : null }}">
                {!! $slide->img('full', ['class' => 'w-100', 'alt' => $slide->name]) !!}
                @php($label = translatedData($slide->getCustomProperty('label')))
                @php($caption = translatedData($slide->getCustomProperty('caption')))
                @if($label || $caption)
                    <div class="carousel-caption d-none d-md-block">
                        @if($label)
                            <h5>{{ $label }}</h5>
                        @endif
                        @if($caption)
                            <p>{{ $caption }}</p>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if($slides->count() > 1)
        <ol class="carousel-indicators">
            @foreach($slides as $key => $slide)
                <li data-target="#label-caption-carousel"
                    data-slide-to="{{ $key }}"
                    class="{{ $loop->first ? 'active' : null }}"></li>
            @endforeach
        </ol>
        <a class="carousel-control-prev" href="#label-caption-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('Previous')</span>
        </a>
        <a class="carousel-control-next" href="#label-caption-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('Next')</span>
        </a>
    @endif
</div>
@push('scripts')
    <script type="text/javascript">
        $(function () {
            const carousel = $('#label-caption-carousel');
            setTimeout(function () {
                const sizes = carousel.find('.carousel-item.active > img').attr('sizes');
                carousel.find('.carousel-item:not(.active) > img').attr('sizes', sizes);
            }, 250);
        });
    </script>
@endpush
