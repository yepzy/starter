const listenToNoClickEvents = () => {
    const $noClickElements = $('[data-no-click]');
    if ($noClickElements.length) {
        return false;
    }
    $noClickElements.click((event) => {
        event.preventDefault();
        return false;
    });
};

listenToNoClickEvents();
