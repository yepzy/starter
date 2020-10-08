const toTitleCase = (string) => {
    const sentence = string.toLowerCase().split(' ');
    for (let ii = 0; ii < sentence.length; ii ++) {
        if (sentence[ii]) {
            sentence[ii] = sentence[ii][0].toUpperCase() + sentence[ii].slice(1);
        }
    }
    return sentence.join(' ');
};

const triggerTitleCaseElementsDetection = () => {
    const $titleCaseElements = $('[data-titlecase]');
    if (! $titleCaseElements.length) {
        return false;
    }
    $titleCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const titleCase = toTitleCase($input.val());
            $input.val(titleCase);
        });
    });
};

triggerTitleCaseElementsDetection();
