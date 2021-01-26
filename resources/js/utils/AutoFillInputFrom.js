import {each} from 'lodash';

/**
 * @param {string} fromInputValue
 * @param {HTMLInputElement} toInput
 * @param {boolean} updated
 */
const autoFill = (fromInputValue, toInput, updated) => {
    if (! updated) {
        toInput.value = fromInputValue;
        toInput.dispatchEvent(new Event('input'));
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
            fromInput.addEventListener('input', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('paste', () => autoFill(fromInput.value, element, updated));
            fromInput.addEventListener('focusout', () => {
                if (fromInput.value || element.value) {
                    updated = true;
                }
            });
            element.addEventListener('focusout', () => {
                updated = !! element.value;
            });
        });
    }

}
