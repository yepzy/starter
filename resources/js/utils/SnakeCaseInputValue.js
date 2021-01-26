import {each, snakeCase} from 'lodash';

let timeout;

/** @param {HTMLInputElement} input */
const convertValueToSnakeCase = (input) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => input.value = snakeCase(input.value), 300);
};

export default class SnakeCaseInputValue {

    static init() {
        each(document.querySelectorAll('[data-snakecase]'), (element) => {
            element.addEventListener('input', () => convertValueToSnakeCase(element));
            element.addEventListener('paste', () => convertValueToSnakeCase(element));
        });
    }

}
