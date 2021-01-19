import _ from 'lodash';
import SweetAlert from '../vendor/SweetAlert';

let confirmationGiven;

const askConfirmation = (message, confirmedCallback) => {
    confirmationGiven = false;
    SweetAlert.alertConfirm(message).then((result) => {
        if (result.value) {
            confirmationGiven = true;
            confirmedCallback();
        }
    });
};

export default class ConfirmationRequest {

    static init = () => {
        _.each(document.querySelectorAll('button[data-confirm], a[data-confirm]'), (element) => {
            const message = element.dataset.confirm;
            if (element instanceof HTMLButtonElement) {
                if (! element.form) {
                    return false;
                }
                element.form.onsubmit((e) => {
                    if (! confirmationGiven) {
                        e.preventDefault();
                        askConfirmation(message, () => {
                            element.form.submit();
                        });
                    }
                });
                return false;
            }
            if (element instanceof HTMLLinkElement) {
                if (! element.href) {
                    return false;
                }
                element.form.onclick((e) => {
                    if (! confirmationGiven) {
                        e.preventDefault();
                        askConfirmation(message, () => {
                            window.location.href = element.href;
                        });
                    }
                });
            }
        });
    };

}
