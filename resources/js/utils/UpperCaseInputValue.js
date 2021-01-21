import _ from 'lodash';

/** @param {HTMLInputElement} input */
const convertValueToUpperCase = (input) => {
    input.value = input.value.toUpperCase();
};

export default class UpperCaseInputValue {

    static init() {
        _.each(document.querySelectorAll('[data-uppercase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToUpperCase(element));
            element.addEventListener('change', () => convertValueToUpperCase(element));
            element.addEventListener('keyup', () => convertValueToUpperCase(element));
            element.addEventListener('input', () => convertValueToUpperCase(element));
            element.addEventListener('paste', () => convertValueToUpperCase(element));
            element.addEventListener('script', () => convertValueToUpperCase(element));
        });
    }

}
