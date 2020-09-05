const $snakeCaseElements = $('[data-snakecase]');

window.triggerSnakeCaseElementsDetection = () => {
    $snakeCaseElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', (event) => {
            const snakeCase = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '_');
            $this.val(snakeCase);
        });
    });
};

if ($snakeCaseElements.length) {
    triggerSnakeCaseElementsDetection();
}
