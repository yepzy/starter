const listenToNewWindowEvents = () => {
    const $newsWindowElements = $('[data-new-window]');
    if (! $newsWindowElements.length) {
        return false;
    }
    _.each($newsWindowElements, (newsWindowElement) => {
        const $this = $(newsWindowElement);
        $this.click((e) => {
            e.preventDefault();
            const target = $this.closest('a').attr('href');
            window.open(target);
        });
    });
};

listenToNewWindowEvents();
