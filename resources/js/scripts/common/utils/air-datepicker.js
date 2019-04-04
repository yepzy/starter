import 'air-datepicker/src/js/air-datepicker';
import 'air-datepicker/dist/js/i18n/datepicker.fr';

const baseConfig = {
    language: 'fr',
    navTitles: {
        days: 'MM yyyy'
    },
    dateFormat: 'dd/mm/yyyy',
    position: 'top left'
};
const dateTimeElements = $('.datetime-picker');
_.each(dateTimeElements, (dateTimeElement) => {
    const $this = $(dateTimeElement);
    const inputMomentDate = moment($this.val(), 'DD/MM/YYYY hh:mm');
    const datePicker = $this.datepicker({
        ...baseConfig, ...{
            timepicker: true,
            timeFormat: 'hh:ii'
        }
    });
    datePicker.data('datepicker').selectDate(inputMomentDate.toDate());
});
