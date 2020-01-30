// This script helps with dropdown menus that appears near to window edge and гоуе
import jQuery from 'jquery';

export default () => {
    const $      = jQuery;
    const ddMenu = $('.menu-dropdown');
    // 1st level sub-menus
    ddMenu.find('>.menu-item').each(function () {
        if ($(this).hasClass('menu-item-has-children')) {
            const _1stLevelSubMenu = $(this).find('>.sub-menu');
            if (_1stLevelSubMenu.length) {
                const _1stLevelSubMenuOffset = _1stLevelSubMenu.offset().left + (_1stLevelSubMenu.outerWidth(true) + 5);

                if (_1stLevelSubMenuOffset > $(window).width() && !_1stLevelSubMenu.attr('style')) {
                    _1stLevelSubMenu.css('left', $(window).width() - _1stLevelSubMenuOffset);
                }
            }
        }
    });

    // 2nd+ level sub-menus
    ddMenu.find('>.menu-item>.sub-menu .sub-menu').each(function () {
        const _2ndLevelSubMenu = $(this);
        const parentSubmenu    = _2ndLevelSubMenu.parents('.sub-menu');

        if (parentSubmenu.hasClass('sub-menus-on-left')) return;

        const _2ndLevelSubMenuOffset = _2ndLevelSubMenu.offset().left + _2ndLevelSubMenu.outerWidth(true);

        if (_2ndLevelSubMenuOffset > $(window).width()) {
            parentSubmenu.addClass('sub-menus-on-left');
        }

    });
};


