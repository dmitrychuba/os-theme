// import external dependencies
const jQuery = require('jquery');

// Import everything from autoload
import './autoload/**/*';

// import local dependencies
import Router from './utils/Router';

// Each route represents a wordpress page,
// e.g. if page name is 'contact us', route should be named 'contactUs'
import home from './routes/home';
import about from './routes/about';
import common from './routes/common';

/** Populate Router instance with DOM routes */
const routes = new Router({
    // Home page
    home,
    // About page
    about,
    // All pages
    common,
});

// Load Events
jQuery($ => routes.loadEvents($));
