// when clicking at .scroll-down it scrolls to next element <section>
import $ from 'jquery';

module.exports = () => {

    $('.scroll-down').on('click', function () {
        const section        = $(this).parents('section');
        const sectionBottom  = section.offset().top + section.outerHeight(true);
        const adminBarHeight = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;
        const isHeaderFixed  = $('header').length && $('header').css('position') === 'fixed';
        const headerHeight   = isHeaderFixed && $('header').length ? $('header').height() : 0;

        $('html, body').animate({
            scrollTop : sectionBottom - adminBarHeight - headerHeight,
        }, 600);
    });
};
