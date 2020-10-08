const triggerLowerCaseElementsDetection = () => {
    const $lowerCaseElements = $('[data-lowercase]');
    if (! $lowerCaseElements.length) {
        return false;
    }
    $lowerCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const lowercase = $input.val().toLowerCase();
            $input.val(lowercase);
        });
    });
};

triggerLowerCaseElementsDetection();
