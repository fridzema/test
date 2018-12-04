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

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});



var uploadErrors = false;

new Dropzone("#dropzone", {
    params: {
      _token: window.Laravel.csrfToken,
    },
    url: '/admin/photos',
    autoProcessQueue: true,
    maxFilesize: 100,
    parallelUploads: 10,
    uploadMultiple: true,
    error: function() {
      uploadErrors = true;
  	},
    queuecomplete: function(){
    	if(!uploadErrors) location.reload();
    }
});

var el = document.getElementById('photos');
var sortable = Sortable.create(el, {
  dataIdAttr: 'data-model-id',
  handle: '.drag-handle',
  sort: true,
  animation: 150,
  scrollSensitivity: 150,
  scrollSpeed: 100,
  onEnd: function (evt) {
	  axios.post('/admin/photos/reorder', {sort_order: sortable.toArray()})
	  .then(function (response) {
	    console.log(response);
	  })
	  .catch(function (error) {
	    console.log(error);
	  });
	},
});