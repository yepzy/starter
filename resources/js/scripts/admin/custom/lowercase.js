const lowercaseInputs = $('.lowercase');
if (lowercaseInputs.length) {
    lowercaseInputs.each((key, input) => {
        $(input).on('propertychange change keyup input paste', () => {
            const value = $(this).val().toLowerCase();
            $(input).val(value);
        });
    });
}
