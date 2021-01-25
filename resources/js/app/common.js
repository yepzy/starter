import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input'
import Moment from '../vendor/Moment';
import CookieConsent from '../vendor/CookieConsent';
import SweetAlert from '../vendor/SweetAlert';
import GLightBox from '../vendor/GLightBox';
import AirDatePicker from '../vendor/AirDatePicker';
import ConfirmationRequest from '../utils/ConfirmationRequest';

// Scripts that will be used globally on both front and admin panel.

// Vendor
bsCustomFileInput.init();
Moment.configure();
CookieConsent.init();
SweetAlert.init();
GLightBox.init();
AirDatePicker.init();

// Utils
ConfirmationRequest.init();
