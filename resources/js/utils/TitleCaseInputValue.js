import {each, startCase, toLower} from 'lodash';

let timeout;

/** @param {HTMLInputElement} input */
const convertValueToTitleCase = (input) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => input.value = startCase(toLower(input.value)), 300);
};

export default class TitleCaseInputValue {

    static init() {
        each(document.querySelectorAll('[data-titlecase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToTitleCase(element));
            element.addEventListener('change', () => convertValueToTitleCase(element));
            element.addEventListener('keyup', () => convertValueToTitleCase(element));
            element.addEventListener('input', () => convertValueToTitleCase(element));
            element.addEventListener('paste', () => convertValueToTitleCase(element));
            element.addEventListener('script', () => convertValueToTitleCase(element));
        });
    }

}
