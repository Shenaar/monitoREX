
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Auth from './services/Auth';
import DateTime from './components/DateTime.vue';
import Vue from 'vue';
import VueHighlightJS from 'vue-highlightjs';
import VueMaterial from 'vue-material';

window.Vue = Vue;

import router from './router';

window.router = router;

Vue.component('DateTime', DateTime);
Vue.use(VueHighlightJS);
Vue.use(VueMaterial);

window.onload = function () {

    const app = new Vue({
        el: '#app',
        router,
        data: () => {
            return {
                Auth
            };
        },
    });
};
