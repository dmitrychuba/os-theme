// import '../util/scrollToNextSection';
import {animateOnScroll, animate} from "../utils/animate";

export default {
    init($) {

        // JavaScript to be fired on the home page
    },
    finalize($) {
        setTimeout(function () {
            $(document).scrollTop(0);
            $('body').addClass('loaded');
            animateOnScroll($('[data-animate]'));
        }, 500);
    },
};
