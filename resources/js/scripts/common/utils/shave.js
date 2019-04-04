window.triggerShaveDetection = () => {
    const shaveElements = $('.shave');
    if (shaveElements.length) {
        $.shave = require('shave/dist/jquery.shave');
        shaveElements.each((key, textElement) => {
            const textContainerHeight = $(textElement).height();
            $(textElement).shave(textContainerHeight);
        });
    }
};
triggerShaveDetection();
$('.modal').on('shown.bs.modal', () => {
    triggerShaveDetection();
});
