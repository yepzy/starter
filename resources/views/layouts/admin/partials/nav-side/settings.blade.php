<li class="nav-item">
    <a class="nav-link load-on-click {{ Str::contains(request()->route()->getName(), ['settings']) ? 'active' : null }}"
       href="{{ route('settings.edit') }}"
       title="@lang('Settings')">
        <i class="fas fa-cogs fa-fw"></i>
        @lang('Settings')
    </a>
</li>