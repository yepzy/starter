<footer id="footer" class="bg-light py-3">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <span class="text-muted">
                <i class="fas fa-copyright fa-fw"></i>
                {{ config('app.name') }}
            </span>
            @if($termsOfService)
                <a class="text-body"
                   href="{{ route('simplePage.show', $termsOfService->url) }}"
                   title="{{ $termsOfService->title }}">
                    {{ $termsOfService->title }}
                </a>
            @endif
            @if($rgpd)
                <a class="text-body"
                   href="{{ route('simplePage.show', $rgpd->url) }}"
                   title="{{ $rgpd->title }}">
                    {{ $rgpd->title }}
                </a>
            @endif
        </div>
    </div>
</footer>
