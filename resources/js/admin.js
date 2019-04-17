require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('uploader', require('./components/Uploader.vue'));
Vue.component('photo-grid', require('./components/PhotoGrid.vue'));
Vue.component('pagination', require('./components/Pagination.vue'));

const app = new Vue({
    el: '#app',
    data: {
      photos: []
    }
});
