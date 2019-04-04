window.bsSwal = swal.mixin({
    customClass: {
        confirmButton: 'btn btn-outline-primary mx-2',
        cancelButton: 'btn btn-outline-danger mx-2'
    },
    buttonsStyling: false
});
if (app.swalConfig) {
    if (app.swalConfig.toast) {
        app.swalConfig.timer = 10000;
        app.swalConfig.position = 'top-right';
    }
    bsSwal.fire(app.swalConfig);
}
