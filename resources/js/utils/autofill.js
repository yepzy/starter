import _ from 'lodash';

/**
 * @param {string} sourceInputValue
 * @param {HTMLInputElement} targetedInput
 * @param {boolean} updated
 */
const autoFill = (sourceInputValue, targetedInput, updated) => {
    if (! updated && ! sourceInputValue) {
        targetedInput.value = sourceInputValue;
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
            sourceElement.addEventListener('propertychange', (e) => autoFill(e.target.value, element, updated));
            sourceElement.addEventListener('change', (e) => autoFill(e.target.value, element, updated));
            sourceElement.addEventListener('keyup', (e) => autoFill(e.target.value, element, updated));
            sourceElement.addEventListener('input', (e) => autoFill(e.target.value, element, updated));
            sourceElement.addEventListener('paste', (e) => autoFill(e.target.value, element, updated));
            sourceElement.addEventListener('focusout', () => updated = true);
            element.addEventListener('focusout', () => updated = true);
        });
    }

}
