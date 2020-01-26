
@php
    $base64Logo = null;
    $imagePath = optional(settings())->getFirstMediaPath('icons', 'mail');
    if ($imagePath) {
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $base64Image = base64_encode(file_get_contents($imagePath));
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
