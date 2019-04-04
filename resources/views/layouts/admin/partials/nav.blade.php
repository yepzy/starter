@php
    $route = request()->route()->getName();
    $user = auth()->user();
@endphp
<nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark w-100 position-fixed">
    <a class="navbar-brand d-flex align-items-center pl-3 pr-3" href="{{ route('admin') }}">
        @if($icon = $settings->media->where('collection_name', 'icon')->first())
            {{ $icon('admin-header') }}
        @endif
        <span {{ classTag($icon ? 'pl-2' : null) }}>{{ config('app.name') }}</span>
    </a>
    <button class="navbar-toggler navbar-toggler-right collapsed"
            type="button"
            data-toggle="collapse"
            data-target="#sidenav"
            aria-controls="sidenav"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- topnav --}}
    <ul id="topnav" class="navbar-nav nav bg-dark flex-column flex-grow-1 align-content-end align-items-end">
        {{-- language --}}
        <li class="nav-item">
            @include('components.common.language.selector', [
                'dropdownLabelClass'    => 'nav-link',
                'dropdownMenuClass'     => 'dropdown-menu-right',
            ])
        </li>
        {{-- logout --}}
        <li {{ classTag('nav-item', $route === 'user.profile' ? 'active' : null) }}>
            <div class="dropdown">
                <a href=""
                   class="dropdown-toggle nav-link"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fas fa-fw fa-user-check text-success"></i>
                    <span class="d-none d-sm-inline-block">
                        {{ $user->name }}
                    </span>
                </a>
                <div {{ classTag('dropdown-menu', 'dropdown-menu-right') }}>
                    <a href="{{ route('user.profile') }}"
                       {{ classTag('dropdown-item', 'spin-on-click', $route === 'user.profile' ? 'active' : null) }}
                       title="{{ __('nav.admin.profile') }}">
                        <i class="fas fa-fw fa-user-circle"></i>
                        @lang('nav.admin.profile')
                    </a>
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" class="p-0" action="{{ route('logout') }}" method="POST">
                        @csrf()
                        <button type="submit"
                                class="dropdown-item btn btn-link"
                                title="{{ __('nav.admin.logout') }}"
                                data-confirm="@lang('notifications.message.logout.confirmation')">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            @lang('nav.admin.logout')
                        </button>
                    </form>
                </div>
            </div>
        </li>
    </ul>
    {{-- sidenav --}}
    <div id="sidenav" class="collapse navbar-collapse bg-dark align-items-start py-3">
        <ul class="navbar-nav nav flex-column w-100">
            @foreach(config('nav.admin') as $menuKey => $menuConfig)
                {{-- divider --}}
                @if($menuConfig === 'divider')
                    <li>
                        <hr class="my-3">
                    </li>
                @else
                    @php
                        // sub menu
                        $subMenu = Arr::get($menuConfig, 'subMenu');
                    @endphp
                    @php
                        // route
                        $menuRoute = Arr::get($menuConfig, 'route');
                        $subMenuRoutes = $subMenu ? array_column($subMenu, 'route') : [];
                        // active
                        $menuActiveWithRoutes = Arr::get($menuConfig, 'activeWithRoutes', []);
                        $subMenusActiveWithRoutes = $subMenu ? Arr::flatten(array_column($subMenu, 'activeWithRoutes')) : [];
                        $menuIsActive = $menuRoute === $route || in_array($route, $menuActiveWithRoutes) || in_array($route, $subMenusActiveWithRoutes);
                        // class
                        $menuClass = Arr::get($menuConfig, 'class');
                        // translation
                        $menuTransKey = Arr::get($menuConfig, 'trans');
                        // icon
                        $menuIcon = Arr::get($menuConfig, 'icon');
                    @endphp
                    {{-- menu --}}
                    <li {{ classTag('nav-item', $menuIsActive ? 'active' : null) }}>
                        <a {{ classTag('nav-link', $menuClass) }}
                            {{ htmlAttributes(['href' => $menuRoute ? route($menuRoute) : '#' . $menuKey]) }}
                            {{ htmlAttributes($menuTransKey ? ['title' => __($menuTransKey)] : null) }}
                            {{ htmlAttributes($subMenu ? [
                                 'data-toggle'      => 'collapse',
                                 'role'             => 'button',
                                 'aria-expanded'    => 'false',
                                 'aria-controls'    => $menuKey
                            ] : null) }}>
                            @if($menuIcon){!! $menuIcon !!}@endif
                            {{ $menuTransKey ? __($menuTransKey) : null }}
                            @if($subMenu)<i class="fas fa-fw fa-caret-down"></i>@endif
                        </a>
                        {{-- submenu --}}
                        @if($subMenu)
                            <ul id="{{ $menuKey }}"
                                {{ classTag('collapse','list-unstyled','bg-light', $menuIsActive ? 'show' : null) }}>
                                @foreach($subMenu as $subMenuKey => $subMenuConfig)
                                    @php
                                        // route
                                        $subMenuRoute = Arr::get($subMenuConfig, 'route');
                                        // active
                                        $subMenuActiveWithRoutes = Arr::get($subMenuConfig, 'activeWithRoutes', []);
                                        $subMenuIsActive = $subMenuRoute === $route || in_array($route, $subMenuActiveWithRoutes);
                                        // class
                                        $subMenuClass = Arr::get($subMenuConfig, 'class');
                                        // translation
                                        $subMenuTransKey = Arr::get($subMenuConfig, 'trans');
                                        // icon
                                        $subMenuIcon = Arr::get($subMenuConfig, 'icon');
                                    @endphp
                                    <li {{ classTag('nav-item', 'text-body', $subMenuIsActive ? 'active' : null) }}>
                                        <a {{ classTag('nav-link', 'text-body', $subMenuClass) }}
                                            {{ htmlAttributes(['href' => $subMenuRoute ? route($subMenuRoute) : null]) }}
                                            {{ htmlAttributes($subMenuTransKey ? ['title' => __($subMenuTransKey)] : null) }}>
                                            @if($subMenuIcon){!! $subMenuIcon !!}@endif
                                            {{ $subMenuTransKey ? __($subMenuTransKey) : null }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
