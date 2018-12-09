require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.Vue = require('vue');
Vue.use(require('vue-resource'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('uploader', require('./components/Uploader.vue'));
Vue.component('photo-grid', require('./components/PhotoGrid.vue'));

// https://itsolutionstuff.com/post/laravel-vue-js-infinite-scroll-example-with-demoexample.html
Vue.component('InfiniteLoading', require('vue-infinite-loading'));

const app = new Vue({
    el: '#app',
    data: {
      photos: []
    }
});
