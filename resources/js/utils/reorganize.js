import _ from 'lodash';
import 'jquery-ui-sortable';
import Notify from '../vendor/Notify';

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
                notify.toastSuccess(response.data.message);
            }).catch((error) => {
                if (error.response) {
                    Notify.toastError(error.response.data.message);
                }
            });
        }
    });
};
