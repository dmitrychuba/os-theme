// Scroll to anchor or element id

const Hash = require('./hash');
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    let href, location, idNoUnderscore, link, id, selector, hTag;

    const scrollTo = function (element) {
        if (element.length > 0 && !element.hasClass('no-scroll-to')) {
            let header         = $('#header').length ? $('#header') : null;
            let headerOffset   = header === null ? 0 : header.offset().top + header.height();
            let adminBarHeight = $('#wpadminbar').length ? $('#wpadminbar').height() : null;
            let offset         = element.first().offset().top;

            if (offset) {

                $('html, body').animate({
                    scrollTop : (offset - headerOffset - adminBarHeight) - 20,
                }, 600);
            }
            return true;
        }

        return false;
    };


    $.fn.scrollTo = function (options) {

        const settings = $.extend({
            onClick : false,
        }, options);

        return this.each(function () {
            $(this).on('click', function (e) {
                href     = $(this).attr('href').split('#');
                id       = href[1] ? href[1] : null;
                link     = href[0] || null;
                location = window.location.href.replace(/#.*/, '');

                settings.onClick && settings.onClick();

                if (id && id.indexOf('tab-') === 0) return false;

                idNoUnderscore = id ? id.replace(/^_/, '') : null;

                selector = '#' + id + ',a[name="' + id + '"]';
                if (id !== idNoUnderscore) {
                    selector += ',#' + idNoUnderscore + ',a[name="' + idNoUnderscore + '"]';
                }
                if (id && (!link || (!link.match(/^http(s)?:/i) && location.indexOf(link)) || link == location)) {
                    if (scrollTo($(selector))) {
                        if (Hash) {
                            Hash.val = id;
                        }
                        e.preventDefault();
                        return false;
                    }
                }
            });


        });


        // $('[data-jump-to]').on('click', function (e) {
        //     hTag     = $(this).data('h-tag');
        //     href     = $(this).data('jump-to');
        //     id       = href[1] || null;
        //     link     = href[0] || null;
        //     location = window.location.href.replace(/#.*/, '');
        //
        //     settings.onClick && settings.onClick();
        //
        //     e.preventDefault();
        //
        //     const element = $(hTag).filter(function () {
        //         return ($(this).text() == href);
        //     });
        //
        //     if (id && (!link || (!link.match(/^http(s)?:/i) && location.indexOf(link)) || link == location)) {
        //         if (scrollTo(element)) {
        //             return false;
        //         }
        //     }
        // });

        if (Hash && Hash.val && typeof Hash.val === 'string') {
            if (Hash.val.match('/')) return;
            id = '#' + Hash.val.replace(/^_/, '');
            scrollTo($(id));
        }

        return this;
    };

}));
