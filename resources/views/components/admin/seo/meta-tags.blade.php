<h3>@lang('SEO')</h3>
{{ inputText()->name('meta_title')
    ->locales(supportedLocaleKeys())
    ->value(fn($locale) => optional($model)->getMeta('meta_title', null, $locale))
    ->caption(__('Recommended length : around :count characters.', ['count' => 50]))
    ->containerHtmlAttributes(['required']) }}
{{ textarea()->name('meta_description')
    ->locales(supportedLocaleKeys())
    ->value(fn($locale) => optional($model)->getMeta('meta_description', null, $locale))
    ->caption(__('Recommended length : around :count characters.', ['count' => 150])) }}
