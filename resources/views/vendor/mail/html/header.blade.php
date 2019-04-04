@php
    $base64Logo = null;
    if ($image = $settings->media->where('collection_name', 'icon')->first()) {
        $imageUrl = $image->getUrl('mail');
        $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
        $data = file_get_contents(public_path($imageUrl));
        $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
@endphp
<tr>
    <td class="header">
        @if($base64Logo)
            <img src="{{ $base64Logo }}" alt="{{ config('app.name') }}">
        @endif
        <a href="{{ $url }}">
            {{ $slot }}
        </a>
    </td>
</tr>
