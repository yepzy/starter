import {each} from 'lodash';

/**
 * @param {string} fromInputValue
 * @param {HTMLInputElement} toInput
 * @param {boolean} updated
 */
const autoFill = (fromInputValue, toInput, updated) => {
    if (! updated) {
        toInput.value = fromInputValue;
        toInput.dispatchEvent(new Event('change'));
    }
};

export default class AutoFillInputFrom {

    static init() {
        each(document.querySelectorAll('input[data-autofill-from]'), (element) => {
            let fromInput = document.querySelector(element.dataset.autofillFrom);
            // Try to get multilingual source input if the monolingual one is not found.
            fromInput = fromInput
                ? fromInput
                : document.querySelector(element.dataset.autofillFrom + '-' + (element.dataset.locale || app.locale));
            let updated = false;
            fromInput.addEventListener('propertychange', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('change', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('keyup', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('input', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('paste', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('focusout', () => {
                if (fromInput.value || element.value) {
                    updated = true;
                }
            });
            element.addEventListener('focusout', () => {
                if (element.value) {
                    updated = true;
                    return false;
                }
                updated = false;
            });
        });
    }

}
