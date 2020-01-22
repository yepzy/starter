window.triggerLowercaseElementsDetection = () => {
    const $lowercaseElements = $('.lowercase');
    if ($lowercaseElements.length) {
        $lowercaseElements.each((key, element) => {
            const $this = $(element);
            $this.on('propertychange change keyup input paste script', () => {
                const lowercase = $this.val().toLowerCase();
                $this.val(lowercase);
            });
        });
    }
};
triggerLowercaseElementsDetection();
