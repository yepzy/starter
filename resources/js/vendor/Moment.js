// More information on https://momentjs.com/

import * as moment from 'moment';

export default class Moment {

    static init() {
        moment.locale(app.locale);
        window.timezone = moment.tz.guess();
    }

}

