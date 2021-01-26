import {each} from 'lodash';

/**
 * @param {HTMLElement} carousel
 * @param {HTMLElement} firstCarouselImage
 * @param {Function} resolve
 */
const getSizesAttribute = (carousel, firstCarouselImage, resolve) => {
    return setTimeout(() => {
        const sizesAttribute = firstCarouselImage.getAttribute('sizes');
        sizesAttribute === '1px' ? getSizesAttribute(carousel, firstCarouselImage, resolve) : resolve(sizesAttribute);
    }, 0);
};

/**
 * @param {HTMLElement} carousel
 * @param {HTMLElement} firstCarouselImage
 * @param {string} inactiveImagesSelector
 */
const setSizesAttributes = (carousel, firstCarouselImage, inactiveImagesSelector) => {
    new Promise(function (resolve) {
        getSizesAttribute(carousel, firstCarouselImage, resolve);
    }).then((sizesAttribute) => {
        const inactiveSlidesImages = carousel.querySelectorAll(inactiveImagesSelector);
        each(inactiveSlidesImages, (inactiveSlidesImage) => {
            inactiveSlidesImage.setAttribute('sizes', sizesAttribute.toString());
        });
    });
};

export default class ResponsiveImages {

    /**
     * @param {string} carouselsSelector
     * @param {string} activeImageSelector
     * @param {string} inactiveImagesSelector
     */
    static setCarouselHiddenImagesSizesAttributes(carouselsSelector, activeImageSelector, inactiveImagesSelector) {
        window.addEventListener('load', () => {
            each(document.querySelectorAll(carouselsSelector), (carousel) => {
                const firstCarouselImage = carousel.querySelector(activeImageSelector);
                firstCarouselImage.complete
                    ? setSizesAttributes(carousel, firstCarouselImage, inactiveImagesSelector)
                    : firstCarouselImage.addEventListener('load', () => setSizesAttributes(
                        carousel,
                        firstCarouselImage,
                        inactiveImagesSelector
                    ));
            });
        });
    }

}
