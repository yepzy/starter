@if(multilingual())
    <div {{ classTag('dropdown', isset($containerClasses) ? $containerClasses : null) }}>
        <a href=""
           {{ classTag('dropdown-toggle', isset($dropdownLabelClass) ? $dropdownLabelClass : null) }}
           id="language-selector"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false">
            <i class="fas fa-fw fa-language"></i>
            @lang('admin.section.language')
        </a>
        <div {{ classTag('dropdown-menu', isset($dropdownMenuClass) ? $dropdownMenuClass : null) }}
             aria-labelledby="language-selector">
            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                <a {{ classTag('dropdown-item', app()->getLocale() === $localeCode ? 'active' : null, isset($dropDownLinkClass) ? $dropDownLinkClass : null) }}
                   rel="alternate"
                   hreflang="{{ $localeCode }}"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <i class="fas fa-fw fa-caret-right"></i>
                    {{ $properties['native'] }}
                </a>
            @endforeach
        </div>
    </div>
@endif
