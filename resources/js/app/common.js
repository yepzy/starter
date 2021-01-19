import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input'
import Moment from '../vendor/Moment';
import CookieConsent from '../vendor/CookieConsent';
import SweetAlert from '../vendor/SweetAlert';
import Lightbox from '../vendor/Lightbox';
import DateTimePickers from '../vendor/DateTimePickers';
import ConfirmationRequest from '../utils/ConfirmationRequest';

// Scripts that will be used globally on both front and admin panel.

// Vendor
bsCustomFileInput.init();
Moment.configure();
CookieConsent.init();
SweetAlert.init();
Lightbox.init();
DateTimePickers.init();

// Utils
ConfirmationRequest.init();
