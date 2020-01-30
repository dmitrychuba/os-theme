import scrollMonitor from "scrollmonitor";
import jQuery from "jquery";
import "./pseudoStyle.jquery";

const $ = jQuery;

const isAnyPartInViewport = function (element) {
    let top    = element.offsetTop;
    let left   = element.offsetLeft;
    let width  = element.offsetWidth;
    let height = element.offsetHeight;

    while (element.offsetParent) {
        element = element.offsetParent;
        top += element.offsetTop;
        left += element.offsetLeft;
    }

    return (
        top < (window.pageYOffset + window.innerHeight) &&
        left < (window.pageXOffset + window.innerWidth) &&
        (top + height) > window.pageYOffset &&
        (left + width) > window.pageXOffset
    );
};

const parseAnimation = $element => {
    const params = $element.data('animate') || ":,";

    const animation = params.split(':')[0] || '';
    const dd        = params.split(':')[1] || '';
    const duration  = dd.split(',')[0] || null;
    const delay     = dd.split(',')[1] || null;
    const once      = !!(dd.split(',')[2] || false);
    return {animation, duration, delay, once};
};

const toMs = s => {return parseFloat(s) * (/\ds$/.test(s) ? 1000 : 1);}

const animateElement = ($element, once, instant) => {
    if ($element.hasClass('animation-end')) return;
    let {animation, duration, delay, _once} = parseAnimation($element);

    delay = instant ? false : delay;

    const isPseudo = animation.match(/pseudo/i);
    const cssObj   = {};

    if (duration) cssObj['animation-duration'] = duration;
    if (delay) cssObj['animation-delay'] = delay;

    if (isPseudo) {
        cssObj['animation-fill-mode'] = 'both';
        $element.addClass(`animated ${animation}`);
        $element.psBeforeAfter(cssObj);
    } else {
        $element.addClass(`animated ${animation}`);
        $element.css(cssObj);
    }
    once = _once || once;

    if (duration || delay) {
        let off = toMs(duration);
        off += delay ? toMs(delay) : 0;
        setTimeout((($element, animation) => {
            return () => {
                if (!isPseudo) {
                    $element.css({
                        'animation-duration' : '',
                        'animation-delay'    : '',
                    });//.removeClass(`${animation}`);

                    if (once === true) {
                        $element.removeAttr('data-animate').removeClass('animated').addClass('animation-end')
                            .removeClass(`${animation}`);
                    }
                }
            }
        })($element, animation), off + 10);
    }

};


const makeWatcherOrAnimate = (element, once) => {
    once = once === undefined ? true : once;

    const watcher = scrollMonitor.create(element);
    if (isAnyPartInViewport(element)) {
        animateElement($(element), once);
    }

    watcher.stateChange(function () {
        const $element = $(this.watchItem);
        const instant  = true;
        if (this.isInViewport) {
            animateElement($element, once, instant);
        } else if (this.isAboveViewport || this.isBelowViewport) {
            // if (!once) {
            //     $element.removeClass(`animated ${animation}`)
            //         .removeAttr('style')
            //         .removeAttr('data-animate');
            // }
        }
    });

    return watcher;
};

const animateOnScroll = ($elements) => {

    $elements.each(function () {
        makeWatcherOrAnimate($(this)[0]);
    });
};

const animate = ($elements, once) => {

    $elements.each(function () {
        animateElement($(this), once);
    });
};

export {animateOnScroll, animate};
