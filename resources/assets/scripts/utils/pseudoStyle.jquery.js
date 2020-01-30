// Adds :before :after pseudo style with javascript (jquery version)

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
    const UID = {
        _current : 0,
        getNew   : function () {
            this._current++;
            return this._current;
        }
    };

    const pseudoStyle = function (element, pseudo, cssPropsObject, options) {

        const settings = $.extend({
            // append : false
        }, options);

        if (Object.keys(cssPropsObject).length === 0 && cssPropsObject.constructor === Object) return this;

        const _this    = element;
        const pseudoId = _this.getAttribute('data-pseudo-id') || UID.getNew();
        const _sheetId = `pseudoStyles${pseudoId}`;
        const _head    = document.head || document.getElementsByTagName('head')[0];
        const _sheet   = document.getElementById(_sheetId) || document.createElement('style');
        _sheet.id      = _sheetId;
        const selector = `[data-pseudo-id="${pseudoId}"]`;

        _this.setAttribute('data-pseudo-id', pseudoId);

        if (pseudo === 'both') {
            _sheet.innerHTML = `${selector}:before,${selector}:after{`;
        } else {
            _sheet.innerHTML = `${selector}:${pseudo}{`;
        }


        let hasContent = false;
        for (let [prop, value] of Object.entries(cssPropsObject)) {
            _sheet.innerHTML += `${prop}:${value};`;
            if (prop == 'content') {
                hasContent = true;
            }
        }

        if (!hasContent) {
            _sheet.innerHTML += `content:'';`;
        }

        _sheet.innerHTML += `}`;

        _head.appendChild(_sheet);
        return this;
    };

    $.fn.psBeforeAfter = function (cssPropsObject, options) {
        return this.each(function () {
            pseudoStyle(this, 'both', cssPropsObject, options);
        });

        return this;
    };

    $.fn.psBefore = function (cssPropsObject, options) {

        return this.each(function () {
            pseudoStyle(this, 'before', cssPropsObject, options);
        });

        return this;
    };

    $.fn.psAfter = function (cssPropsObject, options) {
        return this.each(function () {
            pseudoStyle(this, 'after', cssPropsObject, options);
        });

        return this;
    };

}));
