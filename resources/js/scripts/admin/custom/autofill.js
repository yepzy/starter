const $autofillElements = $('[data-autofill-from]');

window.triggerAutofillElementsDetection = () => {
    $autofillElements.each((key, input) => {
        const $input = $(input);
        const inputLocale = $input.data('locale');
        let $sourceInput = $($input.data('autofillFrom'));
        $sourceInput = $sourceInput.length
            ? $sourceInput // monolingual source input
            : $($input.data('autofillFrom') + '-' + (inputLocale || app.locale)); // multilingual source input
        let manualInterventionRealized = false;
        $sourceInput.on('propertychange change keyup input paste', (event) => {
            if (! manualInterventionRealized) {
                const slug = $(event.target).val();
                $input.val(slug);
                $input.trigger('script');
            }
        });
        $sourceInput.focusout(() => {
            manualInterventionRealized = true;
        });
        $input.focusout(() => {
            manualInterventionRealized = true;
        });
    });
};

if ($autofillElements.length) {
    triggerAutofillElementsDetection();
}
