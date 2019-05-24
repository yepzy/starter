// https://github.com/HemantNegi/jquery.sumoselect
window.triggerSumoSelectDetection = () => {
    const selectorElements = $('.selector');
    if (selectorElements.length) {
        $.SumoSelect = require('sumoselect');
        selectorElements.each((key, select) => {
            const $select = $(select);
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
