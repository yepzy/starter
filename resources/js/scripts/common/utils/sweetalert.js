window.bsSwal = swal.mixin({
    customClass: {
        confirmButton: 'btn btn-outline-primary mx-2',
        cancelButton: 'btn btn-outline-danger mx-2'
    },
    cancelButtonText: app.static.action.cancel,
    buttonsStyling: false
});

bsSwal.loading = (title = app.notifications.title.loading, html = app.templates.loading) => {
    bsSwal.fire({
        title: title,
        html: html,
        type: 'info',
        showConfirmButton: false,
        showCloseButton: false,
        allowOutsideClick: false
    });
};

if (app.swalConfig) {
    bsSwal.fire(app.swalConfig);
}
