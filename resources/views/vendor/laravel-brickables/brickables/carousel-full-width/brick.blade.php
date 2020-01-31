@php
    $carouselId = 'carousel-full-width';
    $slides = $brick->getMedia('slides');
@endphp
@include('components.common.bootstrap.carousel', compact('carouselId', 'slides'))
