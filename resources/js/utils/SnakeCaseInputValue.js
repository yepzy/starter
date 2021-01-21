import _ from 'lodash';

/** @param {HTMLInputElement} input */
const convertValueToSnakeCase = (input) => {
    input.value = input.value.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
        .map(x => x.toLowerCase())
        .join('_');
};

export default class SnakeCaseInputValue {

    static init() {
        _.each(document.querySelectorAll('[data-snakecase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToSnakeCase(element));
            element.addEventListener('change', () => convertValueToSnakeCase(element));
            element.addEventListener('keyup', () => convertValueToSnakeCase(element));
            element.addEventListener('input', () => convertValueToSnakeCase(element));
            element.addEventListener('paste', () => convertValueToSnakeCase(element));
            element.addEventListener('script', () => convertValueToSnakeCase(element));
        });
    }

}
