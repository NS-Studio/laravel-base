window._ = require('lodash');

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueResource from 'vue-resource';
import VeeValidate from 'vee-validate';

Vue.use(VueResource);
Vue.use(BootstrapVue);
Vue.use(VeeValidate);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

const app = new Vue({
    el: '#app',
    http: {

        headers: {

            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        }
    }

});
