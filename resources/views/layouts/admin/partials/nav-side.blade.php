<div id="sidenav" class="collapse navbar-collapse bg-dark align-items-start py-3">
    <ul class="navbar-nav nav flex-column flex-fill w-100">
        {{-- dashboards --}}
        <li class="nav-item">
            <a {{ classTag('nav-link', 'spin-on-click', in_array($route, ['dashboard']) ? 'active' : null) }}
               href="{{ route('dashboard') }}"
               title="@lang('nav.admin.dashboard')">
                <i class="fas fa-tachometer-alt fa-fw"></i>
                @lang('nav.admin.dashboard')
            </a>
        </li>
        {{-- news --}}
        @php($activeMenu = in_array($route, ['news.categories', 'news.categories.create', 'news.categories.edit', 'news.articles', 'news.articles.create', 'news.articles.edit']))
        <li class="nav-item">
            <a {{ classTag('nav-link', $activeMenu ? 'active' : null) }}
               href="#newsMenu"
               title="@lang('nav.admin.news')"
               data-toggle="collapse"
               role="button"
               aria-expanded="false"
               aria-controls="newsMenu">
                <i class="fas fa-newspaper fa-fw"></i>
                @lang('nav.admin.news')
                <i class="fas fa-caret-down fa-fw"></i>
            </a>
            <ul id="newsMenu" {{ classTag(['collapse', 'list-unstyled', $activeMenu ? 'show' : null]) }}>
                <li class="nav-item">
                    <a {{ classTag(['nav-link', 'spin-on-click', in_array($route, ['news.categories', 'news.categories.create', 'news.categories.edit']) ? 'active' : null]) }}
                       href="{{ route('news.categories') }}"
                       title="@lang('nav.admin.categories')">
                        <i class="fas fa-tags fa-fw"></i>
                        @lang('nav.admin.categories')
                    </a>
                </li>
                <li class="nav-item">
                    <a {{ classTag(['nav-link', 'spin-on-click', in_array($route, ['news.articles', 'news.articles.create', 'news.articles.edit']) ? 'active' : null]) }}
                       href="{{ route('news.articles') }}"
                       title="@lang('nav.admin.articles')">
                        <i class="fas fa-scroll"></i>
                        @lang('nav.admin.articles')
                    </a>
                </li>
            </ul>
        </li>
        {{-- simple pages --}}
        <li class="nav-item">
            <a {{ classTag('nav-link', 'spin-on-click', in_array($route, ['simplePages', 'simplePage.create', 'simplePage.edit']) ? 'active' : null) }}
               href="{{ route('simplePages') }}"
               title="@lang('nav.admin.simplePages')">
                <i class="fas fa-file-alt fa-fw"></i>
                @lang('nav.admin.simplePages')
            </a>
        </li>
        {{-- separator --}}
        <hr class="w-100">
        {{-- settings --}}
        <li class="nav-item">
            <a {{ classTag('nav-link', 'spin-on-click', in_array($route, ['settings']) ? 'active' : null) }}
               href="{{ route('settings') }}"
               title="@lang('nav.admin.settings')">
                <i class="fas fa-cogs fa-fw"></i>
                @lang('nav.admin.settings')
            </a>
        </li>
        {{-- users --}}
        <li class="nav-item">
            <a {{ classTag('nav-link', 'spin-on-click', in_array($route, ['users', 'user.create', 'user.edit']) ? 'active' : null) }} href="{{ route('users') }}" title="@lang('nav.admin.users')">
                <i class="fas fa-users fa-fw"></i>
                @lang('nav.admin.users')
            </a>
        </li>
        {{-- separator --}}
        <hr class="w-100">
        {{-- back to the front --}}
        <li class="nav-item">
            <a class="nav-link new-window" href="{{ route('home') }}" title="@lang('nav.admin.users')">
                <i class="fas fa-undo fa-fw"></i>
                @lang('nav.admin.back')
            </a>
        </li>
    </ul>
</div>
