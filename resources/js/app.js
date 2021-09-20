/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue pages. It will recursively scan this directory for the Vue
 * pages and automatically register them with their "basename".
 *
 * Eg. ./pages/ErrorPage.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

require('./pages/registerComponents')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding pages to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from "./store"
import router from "./router"
import VModal from 'vue-js-modal'
import * as VueSpinnersCss from "vue-spinners-css";


Vue.use(VModal);

Vue.use(VueSpinnersCss)

export const bus = new Vue();

const app = new Vue({
    el: '#app',
    store,
    router,
    VModal

});
