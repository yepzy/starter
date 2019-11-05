<li class="nav-item">
    <a{{ classTag('nav-link', 'spin-on-click', in_array($route, ['simplePages', 'simplePage.create', 'simplePage.edit']) ? 'active' : null) }}
       href="{{ route('simplePages') }}"
       title="@lang('nav.admin.simplePages')">
        <i class="fas fa-file-alt fa-fw"></i>
        @lang('nav.admin.simplePages')
    </a>
</li>
