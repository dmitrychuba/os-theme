// `sage preset` installed this file automatically.
// Running `sage preset` again could result in automatic deletion of this file.
// Because of this, we do not recommend editing this file.

// import 'bootstrap/js/dist/modal';
// import 'bootstrap/js/dist/alert';
// import 'bootstrap/js/dist/tab';
// import 'bootstrap/js/dist/util';
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('../components', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({el : '#app'});
