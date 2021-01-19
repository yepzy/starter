import Moment from '../vendor/Moment';
import CookieConsent from '../vendor/CookieConsent';
import SweetAlert from '../vendor/SweetAlert';
import Lightbox from '../vendor/Lightbox';
import DateTimePickers from '../vendor/DateTimePickers';
import ConfirmationRequest from '../utils/ConfirmationRequest';

// Scripts that will be used globally on both front and admin panel.

// Vendor
Moment.configure();
CookieConsent.init();
SweetAlert.init();
Lightbox.init();
DateTimePickers.init();

// Bootstrap overrides
require('../bootstrap-overrides/file-input');
require('../bootstrap-overrides/nav');

// Utils
ConfirmationRequest.init();
require('../utils/no-click');
