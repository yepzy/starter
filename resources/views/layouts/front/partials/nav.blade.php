<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" title="{{ config('app.name') }}">
            @if($icon = $settings->getFirstMedia('icon'))
                {{ $icon('admin-header') }}
            @endif
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarToggler"
                aria-controls="navbarToggler"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item {{ request()->route()->getName() === 'home' ? 'active' : null }}">
                    <a class="nav-link"
                       href="{{ route('home') }}"
                       title="@lang('nav.front.home')">@lang('nav.front.home')
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['news', 'news.article.show'])
                ? 'active'
                : null }}">
                    <a class="nav-link"
                       href="{{ route('news') }}"
                       title="@lang('nav.front.news')">@lang('nav.front.news')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
