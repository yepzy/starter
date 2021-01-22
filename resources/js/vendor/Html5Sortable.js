import {each} from 'lodash';
import axios from 'axios';
import sortable from 'html5sortable/dist/html5sortable.es';
import Axios from './Axios';
import SweetAlert from './SweetAlert';

Axios.configure(axios);

/**
 * @param {HTMLElement} sortableElement
 * @returns {HTMLElement}
 */
const getSortableContainer = (sortableElement) => {
    // By default, the `data-sortable` HTML element will be considered as the sortable container.
    // Declaring `data-sortable-container-selector` will override this behaviour
    // by targeting a custom sortable container.
    const sortableContainerSelector = sortableElement.dataset.sortableContainerSelector;
    return sortableContainerSelector
        ? sortableElement.querySelector(sortableContainerSelector)
        : sortableElement;
};

export default class Html5Sortable {

    static init() {
        const sortableElements = document.querySelectorAll('[data-sortable]');
        each(sortableElements, (element) => {
            const sortableContainer = getSortableContainer(element);
            const sortableElementsSelector = element.dataset.sortableElementsSelector;
            sortable(sortableContainer, {items: sortableElementsSelector})[0]
                .addEventListener('sortupdate', function () {
                    const sortableElements = sortableContainer.querySelectorAll(sortableElementsSelector);
                    let orderedIds = [];
                    each(sortableElements, (element) => {
                        orderedIds.push(element.getElementsByClassName('id')[0].textContent);
                    });
                    axios.post(element.dataset.sortableReorderUrl, {'ordered_ids': orderedIds})
                        .then((response) => {
                            each(sortableElements, (element, key) => {
                                element.getElementsByClassName('position')[0].textContent = key + 1;
                            });
                            SweetAlert.toastSuccess(response.data.message);
                        })
                        .catch((error) => {
                            if (error.response) {
                                SweetAlert.toastError(error.response.data.message);
                            }
                        });
                });
        });
    }

}
