window.triggerSlugifyElementsDetection = () => {
    const slugifyElements = $('.slugify');
    if (slugifyElements.length) {
        slugifyElements.each((key, input) => {
            const $this = $(input);
            const target = $this.data('target');
            let hasLeftTargetInput = false;
            if (!$this.val()) {
                $(target).on('propertychange change keyup input paste', (event) => {
                    if (!hasLeftTargetInput) {
                        const slug = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                        $this.val(slug);
                    }
                });
            }
            $(target).focusout(() => {
                hasLeftTargetInput = true;
            });
            $this.on('propertychange change keyup input paste', (event) => {
                const slug = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                $this.val(slug);
            });
        });
    }
};
triggerSlugifyElementsDetection();
