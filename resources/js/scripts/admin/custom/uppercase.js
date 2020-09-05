const $upperCaseElements = $('[data-uppercase]');

window.triggerUpperCaseElementsDetection = () => {
    $upperCaseElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', () => {
            const upperCase = $this.val().toUpperCase();
            $this.val(upperCase);
        });
    });
};

if ($upperCaseElements.length) {
    triggerUpperCaseElementsDetection();
}
