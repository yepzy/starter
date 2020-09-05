const $titleCaseElements = $('[data-titlecase]');

const toTitleCase = (string) => {
    const sentence = string.toLowerCase().split(' ');
    for(let ii = 0; ii< sentence.length; ii++){
        if(sentence[ii]) {
            sentence[ii] = sentence[ii][0].toUpperCase() + sentence[ii].slice(1);
        }
    }
    return sentence.join(' ');
};

window.triggerTitleCaseElementsDetection = () => {
    $titleCaseElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', () => {
            const titleCase = toTitleCase($this.val());
            $this.val(titleCase);
        });
    });
};

if ($titleCaseElements.length) {
    triggerTitleCaseElementsDetection();
}
