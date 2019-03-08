global.Dropzone = require('dropzone');
global.Sortable = require('sortablejs');
global.OpenSeadragon = require('openseadragon');
global.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

