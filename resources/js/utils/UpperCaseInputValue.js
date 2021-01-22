import {each, toUpper} from 'lodash';

let timeout;

/** @param {HTMLInputElement} input */
const convertValueToUpperCase = (input) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => input.value = toUpper(input.value), 300);
};

export default class UpperCaseInputValue {

    static init() {
        each(document.querySelectorAll('[data-uppercase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToUpperCase(element));
            element.addEventListener('change', () => convertValueToUpperCase(element));
            element.addEventListener('keyup', () => convertValueToUpperCase(element));
            element.addEventListener('input', () => convertValueToUpperCase(element));
            element.addEventListener('paste', () => convertValueToUpperCase(element));
            element.addEventListener('script', () => convertValueToUpperCase(element));
        });
    }

}
