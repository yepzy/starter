export default class MomentConfig {

    static setup = () => {
        moment.locale(app.locale);
        window.timezone = moment.tz.guess();
    }

}

