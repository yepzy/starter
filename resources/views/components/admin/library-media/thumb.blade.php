@if($file && $media = $file->getFirstMedia('media'))
    @if($file->can_be_previewed_in_popin)
        <a href="{{ $media->getUrl() }}" title="{{ __('Preview') }} {{ $file->name }}" data-lightbox>
    @else
        <a href="{{ $media->getUrl() }}" title="{{ __('Download') }} {{ $file->name }}" download="{{ $media->file_name }}">
    @endif
    @if($file->has_preview_image)
        @include('components.admin.media.thumb', ['image' => $media])
    @else
        {!! $file->icon !!}
    @endif
    </a>
@endif
