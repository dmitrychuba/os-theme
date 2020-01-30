import adjustMenus from "../utils/adjustMenus";
import {throttle} from 'throttle-debounce';

export default {
    init($, classRoutes) {

        $('.menu-trigger-button').on('click', () => $('body').toggleClass('menu-open'));

        const adjustElements = throttle(100, () => {
            adjustMenus();
        });

        $(window).on('resize', adjustElements).trigger('resize');

        $(window).on('scroll', throttle(10, () => {
            if (!$('body').hasClass('scroll') && $(window).scrollTop() > 50) {
                $('body').addClass('scroll');
            } else if ($('body').hasClass('scroll') && $(window).scrollTop() <= 50) {
                $('body').removeClass('scroll');
            }
        })).trigger('scroll');
    },

    finalize($) {},
};
