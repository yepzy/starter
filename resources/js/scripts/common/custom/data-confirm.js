window.listenToDataConfirmEvents = (askForConfirmationElements) => {
    const askConfirmation = (event, message, action) => {
        event.preventDefault();
        bsSwal.fire({
            title: app.notifications.title.confirm,
            html: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: app.static.action.confirm,
            cancelButtonText: app.static.action.cancel,
        }).then((result) => {
            if (result.value) {
                action();
            }
        });
    };
    _.each(askForConfirmationElements, (element) => {
        const $this = $(element);
        const message = $this.data('confirm');
        if ($this.is('button') && $this.has('form')) {
            const form = $this.closest('form');
            $this.click((event) => {
                askConfirmation(event, message, () => {
                    form.submit();
                });
            });
        } else if ($this.is('a')) {
            $this.click((event) => {
                askConfirmation(event, message, () => {
                    window.location.href = $this.attr('href');
                });
            });
        }
    });
};
const askForConfirmationElements = $('[data-confirm]');
if(askForConfirmationElements.length) {
    listenToDataConfirmEvents(askForConfirmationElements);
}
