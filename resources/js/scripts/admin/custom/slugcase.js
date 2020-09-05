const $slugCaseElements = $('[data-slugcase]');

window.triggerSlugCaseElementsDetection = () => {
    $slugCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const slugCase = $input.val().replace(/[^a-zA-Z0-9]+/g, '-');
            $input.val(slugCase);
        });
    });
};

if ($slugCaseElements.length) {
    triggerSlugCaseElementsDetection();
}
