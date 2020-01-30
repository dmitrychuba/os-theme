import camelCase from './camelCase';

/**
 * DOM-based Routing
 *
 * Based on {@link http://goo.gl/EUTi53|Markup-based Unobtrusive Comprehensive DOM-ready Execution} by Paul Irish
 *
 * The routing fires all common scripts, followed by the page specific scripts.
 * Add additional events for more control over timing e.g. a finalize event
 */
class Router {

    /**
     * Create a new Router
     * @param {Object} routes
     */
    constructor(routes) {
        this.routes = routes;
    }

    /**
     * Fire Router events
     * @param {string} route DOM-based route derived from body classes (`<body class="...">`)
     * @param {string} [event] Events on the route. By default, `init` and `finalize` events are called.
     * @param {string} [arg] Any custom argument to be passed to the event.
     */
    fire(route, event = 'init', arg, classRoutes) {
        document.dispatchEvent(new CustomEvent('routed', {
            bubbles : true,
            detail  : {
                route,
                fn : event,
            },
        }));

        const fire = route !== '' && this.routes[route] && typeof this.routes[route][event] === 'function';
        if (fire) {
            this.routes[route][event](arg, classRoutes);
        }
    }

    /**
     * Automatically load and fire Router events
     *
     * Events are fired in the following order:
     *  * common init
     *  * page-specific init
     *  * page-specific finalize
     *  * common finalize
     */
    loadEvents(arg) {
        const classRoutes = document.body.className
            .toLowerCase()
            .replace(/-/g, '_')
            .split(/\s+/)
            .map(camelCase);

        // Fire common init JS
        this.fire('common', 'init', arg, classRoutes);

        // Fire page-specific init JS, and then finalize JS
        classRoutes.forEach((className) => {
            this.fire(className, 'init', arg, classRoutes);
            this.fire(className, 'finalize', arg, classRoutes);
        });

        // Fire common finalize JS
        this.fire('common', 'finalize', arg, classRoutes);
    }
}

export default Router;
