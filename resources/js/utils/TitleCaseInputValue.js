import _ from 'lodash';

/** @param {HTMLInputElement} input */
const convertValueToTitleCase = (input) => {
    const sentence = input.value.toLowerCase().split(' ');
    for (let ii = 0; ii < sentence.length; ii++) {
        if (sentence[ii]) {
            sentence[ii] = sentence[ii][0].toUpperCase() + sentence[ii].slice(1);
        }
    }
    input.value = sentence.join(' ');
};

export default class TitleCaseInputValue {

    static init() {
        _.each(document.querySelectorAll('[data-titlecase]'), (element) => {
            element.addEventListener('propertychange', () => convertValueToTitleCase(element));
            element.addEventListener('change', () => convertValueToTitleCase(element));
            element.addEventListener('keyup', () => convertValueToTitleCase(element));
            element.addEventListener('input', () => convertValueToTitleCase(element));
            element.addEventListener('paste', () => convertValueToTitleCase(element));
            element.addEventListener('script', () => convertValueToTitleCase(element));
        });
    }

}
