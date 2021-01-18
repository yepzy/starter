import Notify from '../vendor/Notify';
import _ from 'lodash';

let confirmationGiven;

const askConfirmation = (event, message, actionOnceConfirmed) => {
    confirmationGiven = false;
    Notify.confirm(message).then((result) => {
        if (result.value) {
            confirmationGiven = true;
            actionOnceConfirmed();
        }
    });
};

const listenToDataConfirmEvents = () => {
    const askForConfirmationElements = $('[data-confirm]');
    if (! askForConfirmationElements.length) {
        return false;
    }
    _.each(askForConfirmationElements, (element) => {
        const $this = $(element);
        const message = $this.data('confirm');
        if ($this.is('button') && $this.has('form')) {
            const form = $this.closest('form');
            form.submit((event) => {
                if (! confirmationGiven) {
                    event.preventDefault();
                    askConfirmation(event, message, () => {
                        form.submit();
                    });
                }
            });
        } else if ($this.is('a')) {
            const link = $this.closest('a');
            link.click((event) => {
                if (! confirmationGiven) {
                    event.preventDefault();
                    askConfirmation(event, message, () => {
                        window.location.href = $this.attr('href');
                    });
                }
            });
        }
    });
};

listenToDataConfirmEvents();
