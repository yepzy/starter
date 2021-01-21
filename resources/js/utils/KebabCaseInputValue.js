import _ from 'lodash';

/** @param {HTMLInputElement} input */
const convertValueToKebabCase = (input) => {
    input.value = input.value
        .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
        .map(x => x.toLowerCase())
        .join('-');
};

export default class KebabCaseInputValue {

    static init() {
        _.each(document.querySelectorAll('[data-kebabcase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToKebabCase(element));
            element.addEventListener('change', () => convertValueToKebabCase(element));
            element.addEventListener('keyup', () => convertValueToKebabCase(element));
            element.addEventListener('input', () => convertValueToKebabCase(element));
            element.addEventListener('paste', () => convertValueToKebabCase(element));
            element.addEventListener('script', () => convertValueToKebabCase(element));
        });
    }

}
