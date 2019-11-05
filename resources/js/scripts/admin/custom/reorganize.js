import 'jquery-ui-sortable';

window.reorganizables = ($reorganizableContainer, sortableItemsSelector, reorganizingRoute) => {
    $reorganizableContainer.sortable({
        cursor: 'move',
        update: () => {
            const reorganizedList = $reorganizableContainer.find(sortableItemsSelector);
            const orderedIds = [];
            _.each(reorganizedList, (item) => {
                orderedIds.push($(item).find('.id').text());
            });
            const Toast = bsSwal.mixin({
                toast: true,
                timer: 10000,
                position: 'top-right'
            });
            axios.post(reorganizingRoute, {ordered_ids: orderedIds}).then((response) => {
                _.each(reorganizedList, (item, key) => {
                    $(item).find('.position').text(key + 1);
                });
                Toast.fire({
                    type: 'success',
                    title: response.data.message
                });
            }).catch((error) => {
                if (error.response) {
                    Toast.fire({
                        type: 'error',
                        title: error.response.data.message
                    });
                }
            });
        }
    });
};

