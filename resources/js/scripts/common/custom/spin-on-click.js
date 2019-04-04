window.loadingSpinnerIconHtml = '<i class="fas fa-cog fa-fw fa-spin"></i>';
window.replaceFontAwesomeIconBySpinner = (element) => {
    const html = removeIcon(element);
    element.prepend(loadingSpinnerIconHtml);
    return html;
};
window.removeIcon = (element) => {
    const layers = element.find('.fa-layers');
    const fa = element.find('.fas, .far, .fal, .fab');
    const prefix = element.find('[data-prefix="fas"], [data-prefix="far"], [data-prefix="fal"], [data-prefix="fab"]');
    let html;
    if (layers.length) {
        html = layers.parent().html();
        layers.remove();
    } else if (fa.length) {
        html = fa.parent().html();
        fa.remove();
    } else if (prefix.length) {
        html = prefix.parent().html();
        prefix.remove();
    }
    return html;
};
window.listenToSpinOnClickEvent = (spinOnClickElements) => {
    _.each(spinOnClickElements, (spinOnClickElement) => {
        const $this = $(spinOnClickElement);
        $this.on('click', (e) => {
            e.preventDefault();
            replaceFontAwesomeIconBySpinner($this);
            if ($this.is('button') && $this.has('form')) {
                $this.closest('form').submit();
            } else if ($this.is('a')) {
                window.location.href = $this.attr('href');
            }
        });
    });
};
const spinOnClickElements = $('.spin-on-click');
if (spinOnClickElements.length) {
    listenToSpinOnClickEvent(spinOnClickElements);
}
