// More information on https://github.com/sweetalert2/sweetalert2

const notify = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mx-2',
        cancelButton: 'btn btn-secondary mx-2'
    },
    buttonsStyling: false
});

const popin = notify.mixin({
    showCloseButton: true,
    showConfirmButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: app.notify.confirm,
    cancelButtonText: app.notify.cancel
});

const toast = notify.mixin({
    toast: true,
    position: 'top-end',
    timer: 8000,
    showConfirmButton: false,
    showCloseButton: true
});

const formatArgumentsFromEvent = (event) => {
    return {
        ...event.detail,
        ...{
            willOpen: () => event.detail.willOpen ? setTimeout(event.detail.willOpen, 0) : null,
            didOpen: () => event.detail.didOpen ? setTimeout(event.detail.didOpen, 0) : null,
            didRender: () => event.detail.didRender ? setTimeout(event.detail.didRender, 0) : null,
            willClose: () => event.detail.willClose ? setTimeout(event.detail.willClose, 0) : null,
            didClose: () => event.detail.didClose ? setTimeout(event.detail.didClose, 0) : null,
            didDestroy: () => event.detail.didDestroy ? setTimeout(event.detail.didDestroy, 0) : null
        }
    };
};

export default class Notify {

    static init = () => {
        self.watchSession();
        self.listenToEvents();
    };

    static watchSession = () => {
        if (app.session_notify_config) {
            notify.fire(app.session_notify_config);
        }
    };

    static alertSuccess = (html, title = app.notify.success, config = {}) => {
        return popin.fire({icon: 'success', title, html, ...config});
    };

    static alertError = (html = app.notify.unexpected, title = app.notify.error, config = {}) => {
        return popin.fire({icon: 'error', title, html, ...config});
    };

    static alertInfo = (html, title, config = {}) => {
        return popin.fire({icon: 'info', title, html, ...config});
    };

    static alertQuestion = (html, title, config = {}) => {
        return popin.fire({icon: 'question', title, html, ...config});
    };

    static alertWarning = (html, title, config = {}) => {
        return popin.fire({icon: 'warning', title, html, ...config});
    };

    static alertLoading = (html = app.notify.loading, title = app.notify.please_wait, config = {}) => {
        return Swal.fire({
            icon: 'info',
            title,
            html,
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            willOpen: () => Swal.showLoading(),
            ...config
        });
    };

    static alertConfirm = (html, title = app.notify.confirm_request, config = {}) => {
        return popin.fire({
            icon: 'warning',
            title,
            html,
            showCancelButton: true,
            ...config
        });
    };

    static toastSuccess = (title, html, config) => {
        return toast.fire({icon: 'success', title, html, ...config});
    };

    static toastError = (title, html, config) => {
        return toast.fire({icon: 'error', title, html, ...config});
    };

    static toastInfo = (title, html, config) => {
        return toast.fire({icon: 'info', title, html, ...config});
    };

    static toastQuestion = (title, html, config) => {
        return toast.fire({icon: 'question', title, html, ...config});
    };

    static toastWarning = (title, html, config) => {
        return toast.fire({icon: 'warning', title, html, ...config});
    };

    static toastInvalid = (title = app.notify.invalid, html, config) => {
        return toast.fire({icon: 'error', title, html, ...config});
    };

    static listenToEvents = () => {
        window.addEventListener('popin', event => {
            return popin.fire(formatArgumentsFromEvent(event));
        });
        window.addEventListener('popin:success', event => {
            return this.alertSuccess(event.detail.html, event.detail.title, event.detail.config);
        });
        window.addEventListener('popin:error', event => {
            return this.alertError(event.detail.html, event.detail.title, event.detail.config);
        });
        window.addEventListener('popin:info', event => {
            return this.alertInfo(event.detail.html, event.detail.title, event.detail.config);
        });
        window.addEventListener('popin:question', event => {
            return this.alertQuestion(event.detail.html, event.detail.title, event.detail.config);
        });
        window.addEventListener('popin:loading', event => {
            return this.alertLoading(event.detail.html, event.detail.title, event.detail.config);
        });
        window.addEventListener('popin:confirm', event => {
            return this.alertConfirm(event.detail.html, event.detail.title, event.detail.config);
        });
        window.addEventListener('toast', event => {
            return toast.fire(formatArgumentsFromEvent(event));
        });
        window.addEventListener('toast:success', event => {
            return this.toastSuccess(event.detail.title, event.detail.html, event.detail.config);
        });
        window.addEventListener('toast:error', event => {
            return this.toastError(event.detail.title, event.detail.html, event.detail.config);
        });
        window.addEventListener('toast:info', event => {
            return this.toastInfo(event.detail.title, event.detail.html, event.detail.config);
        });
        window.addEventListener('toast:question', event => {
            return this.toastQuestion(event.detail.title, event.detail.html, event.detail.config);
        });
        window.addEventListener('toast:warning', event => {
            return this.toastWarning(event.detail.title, event.detail.html, event.detail.config);
        });
        window.addEventListener('toast:invalid', event => {
            return this.toastInvalid(event.detail.title, event.detail.html, event.detail.config);
        });
    };

}
