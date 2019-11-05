@php
    $newsArticlesActive = in_array($route, ['news.articles', 'news.articles.create', 'news.articles.edit']);
    $newsCategoriesActive = in_array($route, ['news.categories', 'news.categories.create', 'news.categories.edit']);
    $subMenuActive = $newsArticlesActive || $newsCategoriesActive;
@endphp
<li class="nav-item">
    <a{{ classTag('nav-link', $subMenuActive ? 'active' : null) }}
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
    <ul id="newsMenu" {{ classTag(['collapse', 'list-unstyled', $subMenuActive ? 'show' : null]) }}>
        {{-- articles --}}
        <li class="nav-item">
            <a{{ classTag(['nav-link', 'spin-on-click', $newsArticlesActive ? 'active' : null]) }}
               href="{{ route('news.articles') }}"
               title="@lang('nav.admin.articles')">
                <i class="fas fa-scroll"></i>
                @lang('nav.admin.articles')
            </a>
        </li>
        {{-- categories --}}
        <li class="nav-item">
            <a{{ classTag(['nav-link', 'spin-on-click', $newsCategoriesActive ? 'active' : null]) }}
               href="{{ route('news.categories') }}"
               title="@lang('nav.admin.categories')">
                <i class="fas fa-tags fa-fw"></i>
                @lang('nav.admin.categories')
            </a>
        </li>
    </ul>
</li>
