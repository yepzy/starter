import EasyMdeEditor from '../vendor/EasyMdeEditor';
import MasonryGrid from '../vendor/MasonryGrid';
import Html5Sortable from '../vendor/Html5Sortable';
import AutoFillInputFrom from '../utils/AutoFillInputFrom';
import LowerCaseInputValue from '../utils/LowerCaseInputValue';
import UpperCaseInputValue from '../utils/UpperCaseInputValue';
import TitleCaseInputValue from '../utils/TitleCaseInputValue';
import KebabCaseInputValue from '../utils/KebabCaseInputValue';
import SnakeCaseInputValue from '../utils/SnakeCaseInputValue';
import FlatPickr from '../vendor/FlatPickr';
import bsCustomFileInput from 'bs-custom-file-input';
import ConfirmationRequest from '../utils/ConfirmationRequest';

// Scripts that will be used on the app admin panel.

// Common global scripts
require('./common');

// Vendor
bsCustomFileInput.init();
EasyMdeEditor.init();
MasonryGrid.init();
Html5Sortable.init();
FlatPickr.init();

// Utils
ConfirmationRequest.init();
AutoFillInputFrom.init();
LowerCaseInputValue.init();
UpperCaseInputValue.init();
TitleCaseInputValue.init();
KebabCaseInputValue.init();
SnakeCaseInputValue.init();
