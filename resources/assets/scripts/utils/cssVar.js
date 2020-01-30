// adds css variable to the element via JS
Element.prototype.cssVar = function (name, value) {
    const element = this;

    name = name.match(/^--/) ? name : `--${name}`;
    if (value !== undefined) {
        element.style.setProperty(name, value);
    } else {
        getComputedStyle(element).getPropertyValue(name);
    }
};
