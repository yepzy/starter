import {each} from 'lodash';
import axios from 'axios';
import sortable from 'html5sortable/dist/html5sortable.es';
import Axios from './Axios';
import SweetAlert from './SweetAlert';

Axios.configure(axios);

/**
 * @param {*} $sortableItemsContainer
 * @param {string} sortableItemsSelector
 * @param {*} reorganizingRoute
 */

export default class Sortable {

    /**
     * @param {string} sortableContainerSelector
     * @param {string} sortableElementsSelector
     * @param {string} reorganizingRoute
     */
    static setup(sortableContainerSelector, sortableElementsSelector, reorganizingRoute) {



        console.log(sortableContainerSelector, sortableElementsSelector);
        const sortableContainerElement = document.querySelector(sortableContainerSelector);
        sortable(sortableContainerElement, {items: sortableElementsSelector})[0].addEventListener('sortupdate', function(e) {
            const sortableElements = sortableContainerElement.querySelectorAll(sortableElementsSelector)
            let orderedIds = [];
            each(sortableElements, (element) => {
                orderedIds.push(element.getElementsByClassName('id')[0].textContent);
            });
            axios.post(reorganizingRoute, {'ordered_ids': orderedIds}).then((response) => {
                each(sortableElements, (element, key) => {
                    element.getElementsByClassName('position')[0].textContent = key + 1;
                });
                SweetAlert.toastSuccess(response.data.message);
            }).catch((error) => {
                if (error.response) {
                    SweetAlert.toastError(error.response.data.message);
                }
            });
        });
    }


//    $sortableItemsContainer.sortable({
//        cursor: 'move',
//        update: () => {
//            const reorganizedList = $sortableItemsContainer.find(sortableItemsSelector);
//            let orderedIds = [];
//            each(reorganizedList, (item) => {
//                orderedIds.push($(item).find('.id').text());
//            });
//            axios.post(reorganizingRoute, {'ordered_ids': orderedIds}).then((response) => {
//                each(reorganizedList, (item, key) => {
//                    $(item).find('.position').text(key + 1);
//                });
//                SweetAlert.toastSuccess(response.data.message);
//            }).catch((error) => {
//                if (error.response) {
//                    SweetAlert.toastError(error.response.data.message);
//                }
//            });
//        }
//    });
}
