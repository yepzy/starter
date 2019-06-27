@php
    $base64Logo = null;
    $settings = (new \App\Models\Settings)->first();
    if ($image = optional($settings)->media->where('collection_name', 'icon')->first()) {
        $imageUrl = $image->getPath('mail');
        $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
        $base64Image = base64_encode(file_get_contents($imageUrl));
        $base64Logo = 'data:image/' . $type . ';base64,' . $base64Image;
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
