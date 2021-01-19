import axios from 'axios';
import _ from 'lodash';
import 'jquery-ui-sortable';
import Axios from '../vendor/Axios';
import SweetAlert from '../vendor/SweetAlert';

Axios.configure(axios);

export default ($sortableItemsContainer, sortableItemsSelector, reorganizingRoute) => {
    $sortableItemsContainer.sortable({
        cursor: 'move',
        update: () => {
            const reorganizedList = $sortableItemsContainer.find(sortableItemsSelector);
            let orderedIds = [];
            _.each(reorganizedList, (item) => {
                orderedIds.push($(item).find('.id').text());
            });
            axios.post(reorganizingRoute, {'ordered_ids': orderedIds}).then((response) => {
                _.each(reorganizedList, (item, key) => {
                    $(item).find('.position').text(key + 1);
                });
                SweetAlert.toastSuccess(response.data.message);
            }).catch((error) => {
                if (error.response) {
                    SweetAlert.toastError(error.response.data.message);
                }
            });
        }
    });
};
