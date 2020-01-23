const switcher = {
    langSwitcherLinks: $('#form-lang-switcher a'),
    localizedComponents: $('.component[data-locale]'),
    selectLang: (locale) => {
        const defaultSelectedTab = $('#form-lang-switcher a[data-locale=' + locale + ']');
        switcher.selectTab(defaultSelectedTab);
        switcher.handleLocalizedComponentsDisplay(locale);
    },
    selectTab: ($tab) => {
        switcher.langSwitcherLinks = $('#form-lang-switcher a');
        switcher.langSwitcherLinks.removeClass('active');
        switcher.langSwitcherLinks.attr('aria-selected', false);
        $tab.addClass('active');
        $($tab).attr('aria-selected', true);
    },
    handleLocalizedComponentsDisplay: (locale) => {
        switcher.localizedComponents.closest('.component-container').hide();
        switcher.localizedComponents.filter('[data-locale=' + locale + ']').closest('.component-container').show();
    },
    triggerTabClickListening: () => {
        $('#form-lang-switcher a').click((e) => {
            e.preventDefault();
            switcher.selectLang($(e.target).data('locale'));
        });
    },
    initialize: () => {
        $('#form-notice').after(app.multilingual.template.formLangSwitcher);
        switcher.selectLang(app.locale);
        switcher.triggerTabClickListening();
    }
};

if (switcher.localizedComponents.length) {
    switcher.initialize();
}

