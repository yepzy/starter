import _ from 'lodash';

/**
 * @param {HTMLInputElement} sourceInput
 * @param {HTMLInputElement} targetedInput
 * @param {boolean} updated
 */
const autoFillInputFrom = (sourceInput, targetedInput, updated) => {
    if (! updated && ! sourceInput.value) {
        targetedInput.value = sourceInput.value;
    }
};

export default class AutoFillInputFrom {

    static init() {
        _.each(document.querySelectorAll('input[data-autofill-from]'), (element) => {
            let sourceElement = document.querySelector(element.dataset.autofillFrom);
            // Try to get multilingual source input if the monolingual one is not found.
            sourceElement = sourceElement
                ? sourceElement
                : document.querySelector(element.dataset.autofillFrom + '-' + (element.dataset.locale || app.locale));
            let updated = false;
            sourceElement.addEventListener(
                'propertychange',
                () => autoFillInputFrom(sourceElement, element, updated)
            );
            sourceElement.addEventListener(
                'change',
                () => autoFillInputFrom(sourceElement, element, updated)
            );
            sourceElement.addEventListener(
                'keyup',
                () => autoFillInputFrom(sourceElement, element, updated)
            );
            sourceElement.addEventListener(
                'input',
                () => autoFillInputFrom(sourceElement, element, updated)
            );
            sourceElement.addEventListener(
                'paste',
                () => autoFillInputFrom(sourceElement, element, updated)
            );
            sourceElement.addEventListener('focusout', () => updated = true);
            element.addEventListener('focusout', () => updated = true);
        });
    }

}
