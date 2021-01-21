import EasyMdeEditor from '../vendor/EasyMdeEditor';
import MasonryGrid from '../vendor/MasonryGrid';
import AutoFillInputFrom from '../utils/AutoFillInputFrom';
import LowerCaseInputValue from '../utils/LowerCaseInputValue';
import UpperCaseInputValue from '../utils/UpperCaseInputValue';
import TitleCaseInputValue from '../utils/TitleCaseInputValue';
import KebabCaseInputValue from '../utils/KebabCaseInputValue';
import SnakeCaseInputValue from '../utils/SnakeCaseInputValue';

// Scripts that will be used globally on the admin panel.

// Common global scripts
require('./common');

// Vendor
EasyMdeEditor.init();
MasonryGrid.init();

// Utils
AutoFillInputFrom.init();
LowerCaseInputValue.init();
UpperCaseInputValue.init();
TitleCaseInputValue.init();
KebabCaseInputValue.init();
SnakeCaseInputValue.init();
