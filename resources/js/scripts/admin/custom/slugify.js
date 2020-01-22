window.triggerSlugifyElementsDetection = () => {
    const $slugifyElements = $('.slugify');
    if ($slugifyElements.length) {
        $slugifyElements.each((key, element) => {
            const $this = $(element);
            $this.on('propertychange change keyup input paste script', (event) => {
                const slug = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                $this.val(slug);
            });
        });
    }
};
triggerSlugifyElementsDetection();
