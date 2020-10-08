const triggerUpperCaseElementsDetection = () => {
    const $upperCaseElements = $('[data-uppercase]');
    if (! $upperCaseElements.length) {
        return false;
    }
    $upperCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const upperCase = $input.val().toUpperCase();
            $input.val(upperCase);
        });
    });
};

triggerUpperCaseElementsDetection();
