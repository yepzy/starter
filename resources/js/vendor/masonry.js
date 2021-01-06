// More information on https://github.com/desandro/masonry

const triggerMasonryElementsDetection = () => {
    const masonryElements = document.querySelectorAll('[data-masonry]');
    if (masonryElements.length) {
        const Masonry = require('masonry-layout');
        _.each(masonryElements, (masonryElement) => {
            new Masonry(masonryElement, {
                horizontalOrder: true,
                percentPosition: true,
            });
        });
    }
}

triggerMasonryElementsDetection();
