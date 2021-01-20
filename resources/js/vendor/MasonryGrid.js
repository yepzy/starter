// More information on https://github.com/desandro/masonry

import Masonry from 'masonry-layout';
import _ from 'lodash';

export default class MasonryGrid {

    static init() {
        _.each(document.querySelectorAll('[data-masonry]'), (element) => {
            new Masonry(element, {
                horizontalOrder: true,
                percentPosition: true
            });
        });
    }

}
