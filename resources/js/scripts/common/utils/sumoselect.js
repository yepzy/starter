// https://github.com/HemantNegi/jquery.sumoselect

removeOptionsWithNoValue = ($select) => {
    _.each($select.find('option'), (option) => {
        const $option = $(option);
        if (! $option.val()) {
            $option.remove();
        }
    });
};

window.triggerSumoSelectDetection = () => {
    const selectorElements = $('.selector');
    if (selectorElements.length) {
        $.SumoSelect = require('sumoselect');
        _.each(selectorElements, (select) => {
            const $select = $(select);
            if (select.hasAttribute('multiple')) {
                removeOptionsWithNoValue($select);
            }
            let placeholder = app.sumoSelect.placeholder;
            $select.SumoSelect({
                placeholder: placeholder,
                search: true,
                searchText: app.sumoSelect.searchText,
                noMatch: app.sumoSelect.noMatch,
                captionFormat: app.sumoSelect.captionFormat,
                captionFormatAllSelected: app.sumoSelect.captionFormatAllSelected,
                locale: app.sumoSelect.locales
            });

        });
    }
};

triggerSumoSelectDetection();
