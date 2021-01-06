<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-header">
        <h2 class="m-0">
            {{ $title }}
        </h2>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
