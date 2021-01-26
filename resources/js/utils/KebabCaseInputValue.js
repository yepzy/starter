import {each, kebabCase} from 'lodash';

let timeout;

/** @param {HTMLInputElement} input */
const convertValueToKebabCase = (input) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => input.value = kebabCase(input.value), 300);
};

export default class KebabCaseInputValue {

    static init() {
        each(document.querySelectorAll('[data-kebabcase]'), (element) => {
            element.addEventListener('input', () => convertValueToKebabCase(element));
            element.addEventListener('paste', () => convertValueToKebabCase(element));
        });
    }

}
