import CookieConsentConfig from '../vendor/CookieConsentConfig';
import MomentConfig from '../vendor/MomentConfig';
import Notify from '../vendor/Notify';
import Lightbox from '../vendor/Lightbox';
import DateTimePickers from '../vendor/DateTimePickers';

// Scripts that will be used globally on both front and admin panel.

// Vendor
CookieConsentConfig.setup();
MomentConfig.setup();
Notify.init();
Lightbox.init();
DateTimePickers.init();


// Bootstrap overrides
require('../bootstrap-overrides/file-input');
require('../bootstrap-overrides/nav');

// Utils
require('../utils/confirm');
require('../utils/no-click');
