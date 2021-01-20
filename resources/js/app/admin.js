// Scripts that will be used globally on the admin panel.

import EasyMdeEditor from '../vendor/EasyMdeEditor';
import MasonryGrid from '../vendor/MasonryGrid';

// Common global scripts
require('./common');

// Vendor
EasyMdeEditor.init();
MasonryGrid.init();

// Utils
require('../utils/autofill');
require('../utils/lowercase');
require('../utils/uppercase');
require('../utils/titlecase');
require('../utils/kebabcase');
require('../utils/snakecase');
