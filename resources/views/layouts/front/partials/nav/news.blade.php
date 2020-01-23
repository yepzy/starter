<li class="nav-item {{ Str::contains(request()->route()->getName(), 'news') ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('news.page.show') }}"
       title="@lang('News')">
        @lang('News')
    </a>
</li>
