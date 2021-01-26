// More information on https://github.com/flatpickr/flatpickr

import flatpickr from 'flatpickr';
import {French} from 'flatpickr/dist/l10n/fr.js';

let altFormat;
let time_24hr;

const localize = () => {
    if (app.locale === 'fr') {
        flatpickr.localize(French);
        altFormat = 'j F Y - H:i';
        time_24hr = true;
        return;
    }
    altFormat = 'F j, Y - H:i';
    time_24hr = false;
};

export default class FlatPickr {

    static init() {
        localize();
        this.initDateTimePicker();
    }

    static initDateTimePicker() {
        flatpickr('[data-datetime-picker]', {
            altInput: true,
            altFormat,
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            time_24hr
        });
    }

}
