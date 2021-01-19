export default class Moment {

    static configure() {
        moment.locale(app.locale);
        window.timezone = moment.tz.guess();
    }

}

