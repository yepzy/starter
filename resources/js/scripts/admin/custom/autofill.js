window.triggerAutofillElementsDetection = () => {
    const $autofillElements = $('[data-autofill-from]');
    if ($autofillElements.length) {
        $autofillElements.each((key, element) => {
            _.each(app.supportedLocales, (locale) => {
                const $this = $(element);
                const autofillFrom = $this.data('autofillFrom') + (app.supportedLocales.length > 1 ? '-' + locale : '');
                let manualInterventionRealized = false;
                if (! $this.val()) {
                    $(autofillFrom).on('propertychange change keyup input paste', (event) => {
                        if (! manualInterventionRealized) {
                            const slug = $(event.target).val();
                            $this.val(slug);
                        }
                        $this.trigger('script');
                    });
                }
                $this.focusout(() => {
                    manualInterventionRealized = true;
                });
            });
        });
    }
};
triggerAutofillElementsDetection();
