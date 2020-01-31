@php
    $carouselId = 'carousel-container-width';
    $slides = $brick->getMedia('slides');
@endphp
<div class="container">
    <div class="row">
        @include('components.common.bootstrap.carousel', compact('carouselId', 'slides'))
    </div>
</div>
