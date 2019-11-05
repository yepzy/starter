<li class="nav-item">
    <a{{ classTag('nav-link', 'spin-on-click', in_array($route, ['settings']) ? 'active' : null) }}
       href="{{ route('settings') }}"
       title="@lang('nav.admin.settings')">
        <i class="fas fa-cog fa-fw"></i>
        @lang('nav.admin.settings')
    </a>
</li>
