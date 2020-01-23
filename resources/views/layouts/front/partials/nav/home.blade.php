<li class="nav-item {{ Str::contains(request()->route()->getName(), 'home') ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('home') }}"
       title="@lang('Home')">
        @lang('Home')
    </a>
</li>
