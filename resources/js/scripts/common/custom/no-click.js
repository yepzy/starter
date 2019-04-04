const listenToNoClickEvents = (noClickElements) => {
    noClickElements.click((event) => {
        event.preventDefault();
        return false;
    });
};
const noClickElements = $('.no-click');
if(noClickElements.length){
    listenToNoClickEvents(noClickElements);
}
