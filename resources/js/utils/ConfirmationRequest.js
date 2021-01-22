import {each} from 'lodash';
import SweetAlert from '../vendor/SweetAlert';

/**
 * @param {boolean} confirmationGiven
 * @param {string} message
 * @param {function(): void} confirmedCallback
 */
const askConfirmation = (confirmationGiven, message, confirmedCallback) => {
    SweetAlert.alertConfirm(message).then((result) => {
        if (result.value) {
            confirmationGiven = true;
            confirmedCallback();
        }
    });
};

export default class ConfirmationRequest {

    static init() {
        each(document.querySelectorAll('[type=submit][data-confirm]'), (element) => {
            if (! element.form) {
                return false;
            }
            let confirmationGiven = false;
            const message = element.dataset.confirm;
            element.form.addEventListener('submit', (e) => {
                if (! confirmationGiven) {
                    e.preventDefault();
                    askConfirmation(confirmationGiven, message, () => {
                        element.form.submit();
                    });
                }
            });
        });
        each(document.querySelectorAll(':not([type=submit])[data-confirm]'), (element) => {
            if (! element.href) {
                return false;
            }
            let confirmationGiven = false;
            const message = element.dataset.confirm;
            element.form.addEventListener('click', (e) => {
                if (! confirmationGiven) {
                    e.preventDefault();
                    askConfirmation(confirmationGiven, message, () => {
                        window.location.href = element.href;
                    });
                }
            });
        });
    }

}
