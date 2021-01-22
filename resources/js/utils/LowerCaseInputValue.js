import {each, toLower} from 'lodash';

let timeout;

/** @param {HTMLInputElement} input */
const convertValueToLowerCase = (input) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => input.value = toLower(input.value), 300);
};

export default class LowerCaseInputValue {

    static init() {
        each(document.querySelectorAll('[data-uppercase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToLowerCase(element));
            element.addEventListener('change', () => convertValueToLowerCase(element));
            element.addEventListener('keyup', () => convertValueToLowerCase(element));
            element.addEventListener('input', () => convertValueToLowerCase(element));
            element.addEventListener('paste', () => convertValueToLowerCase(element));
            element.addEventListener('script', () => convertValueToLowerCase(element));
        });
    }

}
