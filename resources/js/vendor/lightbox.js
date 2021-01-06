// More information on https://github.com/biati-digital/glightbox

const getMimeType = (url) => {
    return new Promise(function (resolve) {
        const xhr = new XMLHttpRequest();
        xhr.open('HEAD', url);
        xhr.onreadystatechange = function () {
            if (this.readyState === this.DONE) {
                resolve(this.getResponseHeader('Content-Type'));
            }
        };
        xhr.send();
    });
};

const triggerLightboxElementsDetection = () => {
    const lightboxElements = document.querySelectorAll('[data-lightbox]');
    if (lightboxElements.length) {
        const GLightbox = require('glightbox');
        _.each(lightboxElements, (lightboxElement) => {
            lightboxElement.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                getMimeType(url).then((mimeType) => {
                    const isAudio = mimeType.startsWith('audio/');
                    const lightbox = GLightbox({
                        skin: isAudio ? 'clean audio' : 'clean',
                        elements: [
                            isAudio
                                ? {
                                    content: '<audio class="w-100" controls autoplay><source src="'
                                        + url + '"/></audio>',
                                    height: 'auto'
                                }
                                : {href: url}
                        ],
                        zoomable: false,
                        draggable: false
                    });
                    lightbox.open();
                });
            });
        });
    }
};

triggerLightboxElementsDetection();
