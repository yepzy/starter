<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('dashboard.index') ? ' active' : null }}"
       href="{{ route('dashboard.index') }}"
       title="@lang('Dashboard')">
        <i class="fas fa-tachometer-alt fa-fw"></i>
        @lang('Dashboard')
    </a>
</li>
