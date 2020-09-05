const $kebabCaseElements = $('[data-kebabcase]');

window.triggerSlugifyElementsDetection = () => {
    $kebabCaseElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', (event) => {
            const kebabCase = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
            $this.val(kebabCase);
        });
    });
};

if ($kebabCaseElements.length) {
    triggerSlugifyElementsDetection();
}
