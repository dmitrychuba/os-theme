// Adds :before :after pseudo style with javascript

const UID = {
    _current : 0,
    getNew   : function () {
        this._current++;
        return this._current;
    }
};

const pseudoStyle = function (element, pseudo, cssPropsObject) {

    if (Object.keys(cssPropsObject).length === 0 && cssPropsObject.constructor === Object) return this;

    const _this    = element;
    const pseudoId = _this.getAttribute('data-pseudo-id') || UID.getNew();
    const _sheetId = `pseudoStyles${pseudoId}`;
    const _head    = document.head || document.getElementsByTagName('head')[0];
    const _sheet   = document.getElementById(_sheetId) || document.createElement('style');
    _sheet.id      = _sheetId;
    const selector = `[data-pseudo-id="${pseudoId}"]`;

    _this.setAttribute('data-pseudo-id', pseudoId);

    _sheet.innerHTML = ` ${selector}:${pseudo}{`;

    let hasContent = false;
    for (let [prop, value] of Object.entries(cssPropsObject)) {
        _sheet.innerHTML += `${prop}:${value};`;
        if (prop === 'content') {
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

const psBefore = function (element, cssPropsObject) {
    return pseudoStyle(element, 'before', cssPropsObject);
};

const psAfter = function (element, cssPropsObject) {
    return pseudoStyle(element, 'after', cssPropsObject);
};

export {psBefore, psAfter};
