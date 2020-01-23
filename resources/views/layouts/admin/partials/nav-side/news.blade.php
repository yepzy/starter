@php
    $newsPageActive = Str::contains(request()->route()->getName(), ['news.page']);
    $newsCategoriesActive = Str::contains(request()->route()->getName(), ['news.categories', 'news.category']);
    $newsArticlesActive = Str::contains(request()->route()->getName(), ['news.articles', 'news.article']);
    $subMenuActive = $newsArticlesActive || $newsCategoriesActive;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $subMenuActive ? 'active' : null }}"
       href="#newsMenu"
       title="@lang('News')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-newspaper fa-fw"></i>
        @lang('News')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="newsMenu" class="collapse list-unstyled {{ $subMenuActive ? 'show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link {{ $newsPageActive ? 'active' : null }}"
               href="{{ route('news.page.edit') }}"
               title="@lang('Page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('Page')
            </a>
        </li>
        {{-- categories --}}
        <li class="nav-item">
            <a class="nav-link {{ $newsCategoriesActive ? 'active' : null }}"
               href="{{ route('news.categories.index') }}"
               title="@lang('Categories')">
                <i class="fas fa-tags fa-fw"></i>
                @lang('Categories')
            </a>
        </li>
        {{-- articles --}}
        <li class="nav-item">
            <a class="nav-link {{ $newsArticlesActive ? 'active' : null }}"
               href="{{ route('news.articles.index') }}"
               title="@lang('Articles')">
                <i class="fas fa-paper-plane fa-fw"></i>
                @lang('Articles')
            </a>
        </li>
    </ul>
</li>
