// import Sortable from 'sortablejs';

window._ = require('lodash');

/**
 * Library for dinamyc ordering of html elements
 * 
 */
window.Sortable = require('sortablejs').Sortable;

/**
 * Library for animation on scroll
 * 
 */
window.AOS = require('aos')

/**
 * Library for time 
 * 
 */
window.moment = require('moment')

/**
 * Library for input formatting
 * 
 */
window.Cleave = require('cleave.js/dist/cleave');

/**
 * Library for sweet alerts
 * 
 */
window.Swal = require('sweetalert2/dist/sweetalert2.all');

/**
 * Library for frontend replacer
 * 
 */
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

/**
 * Library for progress bar
 * 
 */
window.ProgressBar = require('progressbar.js/dist/progressbar')


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
window.ClassicEditor = ClassicEditor

/**
 * 
 * 
 */

import Draggy from './draggy'
window.Draggy = Draggy