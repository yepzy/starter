import _ from 'lodash';

/** @param {HTMLInputElement} input */
const convertValueToLowerCase = (input) => {
    input.value = input.value.toLowerCase();
};

export default class LowerCaseInputValue {

    static init() {
        _.each(document.querySelectorAll('[data-uppercase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToLowerCase(element));
            element.addEventListener('change', () => convertValueToLowerCase(element));
            element.addEventListener('keyup', () => convertValueToLowerCase(element));
            element.addEventListener('input', () => convertValueToLowerCase(element));
            element.addEventListener('paste', () => convertValueToLowerCase(element));
            element.addEventListener('script', () => convertValueToLowerCase(element));
        });
    }

}
