const $lowerCaseElements = $('[data-lowercase]');

window.triggerLowerCaseElementsDetection = () => {
    $lowerCaseElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', () => {
            const lowercase = $this.val().toLowerCase();
            $this.val(lowercase);
        });
    });
};

if ($lowerCaseElements.length) {
    triggerLowerCaseElementsDetection();
}
