import ResponsiveImages from '../utils/ResponsiveImages';

ResponsiveImages.setCarouselHiddenImagesSizesAttributes(
    '.carousel',
    '.carousel-item.active > img',
    '.carousel-item:not(.active) > img'
);
